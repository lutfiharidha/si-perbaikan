<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fasilitas;
use App\Ruang;
use App\Kerusakan;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        $pengaduan = Kerusakan::count();
        $diterima = Kerusakan::where('status', 'Approved')->count();
        $diproses = Kerusakan::where('status', 'Proses')->count();
        $ditolak = Kerusakan::where('status', 'Cancel')->count();
        $siap = Kerusakan::where('status', 'Finished')->count();
        return view('admin.dashboard', compact('pengaduan','diterima','diproses','ditolak','siap'));
    }

    public function inputRuang()
    {
        return view('admin.inputRuang');
    }

    public function storeRuang(Request $request)
    {
        $ruang = new Ruang;
        $ruang->nama_ruang = $request->nama_ruang;
        $ruang->asrama = $request->asrama;
        $ruang->tingkatan = $request->tingkatan;
        $ruang->save();

        return redirect()->route('admin.laporanRuang')->with('success', 'Ruang Telah Ditambah');
    }

    public function editRuang($id)
    {
        $ruang = Ruang::findOrfail($id);

        return view('admin.editRuang', compact('ruang'));
    }

    public function updateRuang(Request $request, $id)
    {
        $ruang = Ruang::findOrfail($id);
        $ruang->nama_ruang = $request->nama_ruang;
        $ruang->asrama = $request->asrama;
        $ruang->tingkatan = $request->tingkatan;
        $ruang->save();

        return redirect()->route('admin.laporanRuang')->with('success', 'Ruang Telah Di Update');
    }

    public function laporanRuang()
    {
        $ruang = Ruang::all();
        return view('admin.laporanRuang', compact('ruang'));
    }

    public function deleteRuang(Ruang $ruang)
    {
        $ruang->delete();
        return redirect()->route('admin.laporanRuang')->with('success', 'Ruang Telah Dihapus');
    }

    public function inputFasilitas()
    {
        return view('admin.inputFasilitas');
    }

    public function storeFasilitas(Request $request)
    {
        $fasilitas = new Fasilitas;
        $fasilitas->nama_fasilitas = $request->fasilitas;
        $fasilitas->jumlah = $request->jumlah;
        $fasilitas->ruang_id = $request->ruang;
        $fasilitas->save();

        return redirect()->route('admin.laporanFasilitas')->with('success', 'Fasilitas Telah Ditambah');
    }

    public function editFasilitas($id)
    {
        $fasilitas = Fasilitas::findOrfail($id);

        return view('admin.editFasilitas', compact('fasilitas'));
    }

    public function updateFasilitas(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrfail($id);
        $fasilitas->nama_fasilitas = $request->fasilitas;
        $fasilitas->jumlah = $request->jumlah;
        $fasilitas->ruang_id = $request->ruang;
        $fasilitas->save();

        return redirect()->route('admin.laporanFasilitas')->with('success', 'Fasilitas Telah Di Update');
    }

    public function laporanFasilitas()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.laporanFasilitas', compact('fasilitas'));
    }

    public function deleteFasilitas(Fasilitas $fasilitas)
    {
        $fasilitas->delete();
        return redirect()->route('admin.laporanFasilitas')->with('success', 'Fasilitas Telah Dihapus');
    }

    public function laporanPerbaikan()
    {
        $arrLaporan = Fasilitas::all();
        $fasilitasi = $arrLaporan->unique('nama_fasilitas');
        return view('admin.laporanPerbaikan', compact('fasilitasi'));
    }

    public function laporanKerusakan()
    {
        $arrLaporan = Kerusakan::latest()->get();
        return view('admin.laporanKerusakan', compact('arrLaporan'));
    }

    public function editKerusakan($id)
    {
        $kerusakan = Kerusakan::findOrFail($id);
        return view('admin.editKerusakan', compact('kerusakan'));
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

        return redirect()->route('laporanKerusakan')->with('success', 'Kerusakan Telah Diperbarui');
    }

    public function deleteKerusakan(Kerusakan $kerusakan)
    {
        $kerusakan->delete();
        return redirect()->route('laporanKerusakan')->with('success', 'Kerusakan Telah Dihapus');
    }

    public function laporanUser()
    {
        $users = User::all();
        return view('admin.laporanUser', compact('users'));
    }

    public function inputUser()
    {
        return view('admin.inputUser');
    }

    public function storeUser(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'jabatan' => 'required|string',
        ]);
        if($request->jabatan == 'Kepala Asrama'){
            $level = 'asrama';
        }elseif($request->jabatan == 'Kepala Unit'){
            $level = 'admin';
        }else{
            $level = 'sekolah';
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->password = bcrypt($request->password);
        $user->level = $level;
        $user->jabatan = $request->jabatan;
        $user->save();

        return redirect()->route('laporanUser')->with('success', 'User Telah Ditambah');
    }

    public function editUser($id)
    {
        $user = User::findOrfail($id);
        return view('admin.editUser', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'jabatan' => 'required|string',
        ]);

        if($request->jabatan == 'Kepala Asrama'){
            $level = 'asrama';
        }elseif($request->jabatan == 'Kepala Unit'){
            $level = 'admin';
        }else{
            $level = 'sekolah';
        }
        
        $user = User::findOrfail($id);
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        if ($request->password) {
            $this->validate($request,[
                'password' => 'min:8|confirmed',
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->level = $level;
        $user->jabatan = $request->jabatan;
        $user->save();

        return redirect()->route('laporanUser')->with('success', 'User Telah Ditambah');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('laporanUser')->with('success', 'User Telah Dihapus');
    }
    
}
