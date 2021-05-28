<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kerusakan;
use App\Ruang;
use App\Fasilitas;
use DB;
class SekolahController extends Controller
{
    public function index()
    {
        $pengaduan = Kerusakan::count();
        $diterima = Kerusakan::where('status', 'Approved')->count();
        $diproses = Kerusakan::where('status', 'Proses')->count();
        $ditolak = Kerusakan::where('status', 'Cancel')->count();
        $siap = Kerusakan::where('status', 'Finished')->count();
        return view('sekolah.dashboard', compact('pengaduan','diterima','diproses','ditolak','siap'));
    }

    public function dataPerbaikan()
    {
        $arrLaporan = Kerusakan::all();
        return view('sekolah.laporanKerusakan', compact('arrLaporan'));
    }

    public function dataFasilitas($tingkatan, $asrama = null)
    {
        if(!$asrama){
            $ruangan =  Ruang::where('tingkatan', $tingkatan)->get();
        }else{
            $ruangan =  Ruang::where('tingkatan', $tingkatan)->where('asrama', $asrama)->get();
        }
        $fasilitas =  DB::table('fasilitas')
        ->join('ruang', 'fasilitas.ruang_id', 'ruang.id')
        ->where('ruang.tingkatan', $tingkatan)
        ->select('*', 'fasilitas.id as fasilitas_id')
        ->get();
        $kerusakan = DB::table('kerusakan')
        ->join('fasilitas', 'kerusakan.fasilitas_id', 'fasilitas.id')
        ->join('ruang', 'fasilitas.ruang_id', 'ruang.id')
        ->where('ruang.tingkatan', $tingkatan)
        ->get();
        return view('sekolah.laporanFasilitas', compact('kerusakan', 'ruangan', 'fasilitas'));

    }
    public function editKerusakan($id)
    {
        $kerusakan = Kerusakan::findOrFail($id);
        return view('sekolah.editKerusakan', compact('kerusakan'));
    }

    public function updateKerusakan(Request $request, $id)
    {
        $kerusakan = Kerusakan::findOrFail($id);
        $kerusakan->biaya = $request->biaya;
        if ($request->has('status')) {
            $kerusakan->status = $request->status;
        }
        $kerusakan->deskripsi = $request->deskripsi;
        $kerusakan->save();

        return redirect()->route(auth()->user()->level.'.dataPerbaikan')->with('success', 'Kerusakan Telah Diperbarui');
    }

    public function deleteKerusakan(Kerusakan $kerusakan)
    {
        $kerusakan->delete();
        return redirect()->route(auth()->user()->level.'.dataPerbaikan')->with('success', 'Kerusakan Telah Dihapus');
    }

    public function dataKerusakan()
    {
        $arrKerusakan = Kerusakan::all();
        return view('sekolah.laporan', compact('arrKerusakan'));
    }

    public function inputKerusakan()
    {
        return view('sekolah.inputKerusakan');
    }

    public function storeKerusakan(Request $request)
    {
        $fasilitas = Fasilitas::find($request->fasilitas);
        if ($request->tingkatan == 'total') {
            if ($request->total > $fasilitas->jumlah) {
                return redirect()->back()->with('error', 'Jumlah total kerusakan melebihi jumlah fasilitas');
            }else{
                $fasilitas->jumlah -= $request->total;
                $fasilitas->save();
            }

        }
        $fotoFasilitas = $request->foto;
        $nameFasilitas = rand(3000,999999).$fotoFasilitas->getClientOriginalName();
        $destinationPath = public_path().'/img/fasilitas/';
        $fotoFasilitas->move($destinationPath,$nameFasilitas);

        $kerusakan = new Kerusakan;
        $kerusakan->fasilitas_id = $request->fasilitas;
        $kerusakan->total = $request->total;
        $kerusakan->deskripsi = $request->deskripsi;
        $kerusakan->foto = $nameFasilitas;
        $kerusakan->tingkat = $request->tingkatan;
        $kerusakan->user_id = auth()->user()->id;
        $kerusakan->save();

        

        return redirect()->route(auth()->user()->level.'.dataPerbaikan')->with('success', 'Pengajuan kerusakan telah berhasil');
    }

    public function inputRuang()
    {
        return view('sekolah.inputRuang');
    }

    public function storeRuang(Request $request)
    {
        $ruang = new Ruang;
        $ruang->nama_ruang = $request->nama_ruang;
        $ruang->asrama = $request->asrama;
        $ruang->tingkatan = $request->tingkatan;
        $ruang->save();

        return redirect()->route('sekolah.laporanRuang')->with('success', 'Fasilitas Telah Ditambah');
    }

    public function editRuang($id)
    {
        $ruang = Ruang::findOrfail($id);

        return view('sekolah.editRuang', compact('ruang'));
    }

    public function updateRuang(Request $request, $id)
    {
        $ruang = Ruang::findOrfail($id);
        $ruang->nama_ruang = $request->nama_ruang;
        $ruang->asrama = $request->asrama;
        $ruang->tingkatan = $request->tingkatan;
        $ruang->save();

        return redirect()->route('sekolah.laporanRuang')->with('success', 'Ruang Telah Di Update');
    }

    public function laporanRuang()
    {
        $ruang = Ruang::all();
        return view('sekolah.laporanRuang', compact('ruang'));
    }

    public function deleteRuang(Ruang $ruang)
    {
        $ruang->delete();
        return redirect()->route('sekolah.laporanRuang')->with('success', 'Ruang Telah Dihapus');
    }

    public function inputFasilitas()
    {
        return view('sekolah.inputFasilitas');
    }

    public function storeFasilitas(Request $request)
    {
        $fasilitas = new Fasilitas;
        $fasilitas->nama_fasilitas = $request->fasilitas;
        $fasilitas->jumlah = $request->jumlah;
        $fasilitas->ruang_id = $request->ruang;
        $fasilitas->save();

        $ruang = Ruang::find($fasilitas->ruang_id);
        if($ruang->tingkatan == 'umum'){
            return redirect()->route('sekolah.dataFasilitas', [$ruang->tingkatan, ''])->with('success', 'Fasilitas Telah Ditambah');
        }else{
            return redirect()->route('sekolah.dataFasilitas', [$ruang->tingkatan, $ruang->asrama])->with('success', 'Fasilitas Telah Ditambah');

        }
    }

    public function editFasilitas($id)
    {
        $fasilitas = Fasilitas::findOrfail($id);

        return view('sekolah.editFasilitas', compact('fasilitas'));
    }

    public function updateFasilitas(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrfail($id);
        $fasilitas->nama_fasilitas = $request->fasilitas;
        $fasilitas->jumlah = $request->jumlah;
        $fasilitas->ruang_id = $request->ruang;
        $fasilitas->save();

        return redirect()->route('sekolah.laporanFasilitas')->with('success', 'Fasilitas Telah Di Update');
    }

    public function deleteFasilitas($id)
    {
        $fasilitas =Fasilitas::findOrFail($id);
        $ruang = Ruang::find($fasilitas->ruang_id);
        $fasilitas->delete();

        if($ruang->tingkatan == 'umum'){
            return redirect()->route('sekolah.dataFasilitas', [$ruang->tingkatan, ''])->with('success', 'Fasilitas Telah Dihapus');
        }else{
            return redirect()->route('sekolah.dataFasilitas', [$ruang->tingkatan, $ruang->asrama])->with('success', 'Fasilitas Telah Dihapus');

        }
    }

    public function laporanPerbaikan()
    {
        $arrLaporan = Fasilitas::all();
        $fasilitasi = $arrLaporan->unique('nama_fasilitas');
        return view('sekolah.laporanPerbaikan', compact('fasilitasi'));
    }
}
