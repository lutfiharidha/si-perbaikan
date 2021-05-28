<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruang;
use DB;
class APIController extends Controller
{
    public function loadData(Request $request)
    {
        if ($request->has('asrama') || $request->has('tingkatan')) {
            $asrama = $request->asrama;
            $tingkatan = $request->tingkatan;
            $ruangan = Ruang::select('id','nama_ruang')->where('asrama', $asrama)->where('tingkatan', $tingkatan)->get();
            return response()->json($ruangan);
        }
        if ($request->has('ruang')) {
            $ruang = $request->ruang;
            $ruangan = Ruang::findOrfail($ruang);
            return response()->json($ruangan->ruang_has_fasilitas);
        }
        if ($request->has('fasilitas')) {
            if ($request->fasilitas == 'all') {
                $kerusakan = DB::table('kerusakan')
                ->join('fasilitas', 'kerusakan.fasilitas_id', 'fasilitas.id')
                ->join('ruang', 'fasilitas.ruang_id', 'ruang.id')
                ->select('fasilitas.nama_fasilitas', 'ruang.nama_ruang', 'ruang.asrama', 'ruang.tingkatan', 'kerusakan.biaya', DB::raw('DATE_FORMAT(kerusakan.created_at,"%d %b %Y") as created_at'), DB::raw('DATE_FORMAT(kerusakan.updated_at,"%d %b %Y") as updated_at') )
                ->where('kerusakan.status', 'Finished')
                ->orderBy('fasilitas.nama_fasilitas', 'ASC')
                ->get();
                return response()->json($kerusakan);
            }else{
                $kerusakan = DB::table('kerusakan')
                ->join('fasilitas', 'kerusakan.fasilitas_id', 'fasilitas.id')
                ->join('ruang', 'fasilitas.ruang_id', 'ruang.id')
                ->select('fasilitas.nama_fasilitas', 'ruang.nama_ruang', 'ruang.asrama', 'ruang.tingkatan', 'kerusakan.biaya', DB::raw('DATE_FORMAT(kerusakan.created_at,"%d %b %Y") as created_at'), DB::raw('DATE_FORMAT(kerusakan.updated_at,"%d %b %Y") as updated_at') )
                ->where('fasilitas.nama_fasilitas', $request->fasilitas)
                ->where('kerusakan.status', 'Finished')
                ->get();
                return response()->json($kerusakan);
            }            
        }
    }
}
