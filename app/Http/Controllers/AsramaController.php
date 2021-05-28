<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kerusakan;
use App\Fasilitas;

class AsramaController extends Controller
{
    public function index()
    {
        $pengaduan = Kerusakan::count();
        $diterima = Kerusakan::where('status', 'Approved')->count();
        $diproses = Kerusakan::where('status', 'Proses')->count();
        $ditolak = Kerusakan::where('status', 'Cancel')->count();
        $siap = Kerusakan::where('status', 'Finished')->count();
        return view('asrama.dashboard', compact('pengaduan','diterima','diproses','ditolak','siap'));
    }

    public function dataPerbaikan()
    {
        $arrLaporan = Kerusakan::where('user_id', auth()->user()->id)->get();
        return view('asrama.laporanPerbaikan', compact('arrLaporan'));
    }
    public function inputKerusakan()
    {
        return view('asrama.inputKerusakan');
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
}
