<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\provinsi;
use App\Models\kasus2;

class ProvinsiController extends Controller
{


    public function index()
    {
        $tampil = DB::table('provinsis')
        ->select('nama_provinsi','kode_provinsi',
        DB::raw('sum(kasus2s.jumlah_positif) as jumlah_positif'),
        DB::raw('sum(kasus2s.jumlah_sembuh) as jumlah_sembuh'),
        DB::raw('sum(kasus2s.jumlah_meninggal) as jumlah_meninggal'))
        ->join('kotas','kotas.id_provinsi','=','provinsis.id')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('kasus2s','kasus2s.id_rw','=','rws.id')
        ->groupBy('nama_provinsi','kode_provinsi')
        ->get();

        $data = [
            'success' => true,
            'Data Provinsi' => $tampil,
            'message' => 'Data Kasus Di tampilkan'
        ];
return response()->json($data,200);
//         $positif = DB::table('provinsis')->select('kasus2s.jumlah_positif','kasus2s.jumlah_sembuh','kasus2s.jumlah_meninggal')
//         ->join('kotas','kotas.id','=','kotas.id_provinsi')
//         ->join('kecamatans','kotas.id','=','kecamatans.id_kota')
//         ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
//         ->join('rws','kelurahans.id','=','rws.id_kelurahan')
//         ->join('kasus2s','rws.id','=','kasus2s.id_rw')
//         ->sum('kasus2s.jumlah_positif');
       
       
//         $sembuh = DB::table('rws')->select('kasus2s.jumlah_positif','kasus2s.jumlah_sembuh','kasus2s.jumlah_meninggal')
//         ->join('kotas','kotas.id','=','kotas.id_provinsi')
//         ->join('kecamatans','kotas.id','=','kecamatans.id_kota')
//         ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
//         ->join('rws','kelurahans.id','=','rws.id_kelurahan')
//         ->join ('kasus2s','rws.id','=','kasus2s.id_rw')
//         ->sum('kasus2s.jumlah_sembuh');

//         $meninggal = DB::table('rws')->select('kasus2s.jumlah_positif','kasus2s.jumlah_sembuh','kasus2s.jumlah_meninggal')
//         ->join('kotas','kotas.id','=','kotas.id_provinsi')
//         ->join('kecamatans','kotas.id','=','kecamatans.id_kota')
//         ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
//         ->join('rws','kelurahans.id','=','rws.id_kelurahan')
//         ->join ('kasus2s','rws.id','=','kasus2s.id_rw')
//         ->sum('kasus2s.jumlah_meninggal');

//         $provv = provinsi::findOrFail($id);

//         $res = [
//             'success' => true,
//             'Data' => 'Data Kasus provinsi',
//             'Nama Preovinsi' => $provv,
//             'jumlah Positif' => $positif,
//             'Jumlah Sembuh' => $sembuh,
//             'jumlah Meninggal' => $meninggal,
//             'message' => 'Data Kasus Di tampilkan'
//         ];
// return response()->json($res,200);



        $provinsi = Provinsi::latest()->get();
      $res = [
          'success' => true,
          'data' => $provinsi,
          'message' => 'Data Provinsi Di Tampilkan'
      ];

      return response()->json($res,200);


    }
     
    // public function index()
    // {
    //     //
    // }

    
    // public function create()
    // {
    //     //
    // }

    
    public function store(Request $request)
    {
        $provinsi = new provinsi();
        $provinsi->kode_provinsi = $request->kode_provinsi;
        $provinsi->nama_provinsi = $request->nama_provinsi;
        $provinsi->save();

        $res = [
            'success'=> true,
            'data' => $provinsi,
            'message' => 'data berhasil di simpan'
        ];

        return response()->json($res,200);
    }

    
    public function show($id)
    {
        $prov = DB::table('kasus2s')
                ->select( DB::raw('provinsis.nama_provinsi as provinsi'),
                          DB::raw('SUM(kasus2s.jumlah_positif) as positif'),
                          DB::raw('SUM(kasus2s.jumlah_sembuh) as sembuh'),
                          DB::raw('SUM(kasus2s.jumlah_meninggal) as meninggal'))
                                ->join('rws','rws.id_kelurahan','=','kelurahans.id')
                                ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
                                ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
                                ->join('provinsis','provinsis.id','=','kotas.id_provinsis')
                                ->join('kotas','kotas.id_provinsi','=','provinsis.id')
                                ->where('provinsis.id',$id)
                                ->groupBy('provinsis.nama_provinsi')
                                ->get();
        $res = [
            'success' => true,
            'data' => $prov,
            'message' => 'BERHASIL GOOD LUCK'
        ];
        return response()->json($res,200);

//         $positif = DB::table('provinsis')->select('kasus2s.jumlah_positif','kasus2s.jumlah_sembuh','kasus2s.jumlah_meninggal')
//         ->join('kotas','kotas.id_provinsi','=','provinsis.id')
//         ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
//         ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
//         ->join('rws','rws.id_kelurahan','=','kelurahans.id')
//         ->join('kasus2s','kasus2s.id_rw','=','rws.id')
//         ->sum('kasus2s.jumlah_positif');
//         // ->where('provinsi.id'$id)
       
//         $sembuh = DB::table('rws')->select('kasus2s.jumlah_positif','kasus2s.jumlah_sembuh','kasus2s.jumlah_meninggal')
//         ->join('kotas','kotas.id_provinsi','=','provinsis.id')
//         ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
//         ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
//         ->join('rws','rws.id_kelurahan','=','kelurahans.id')
//         ->join('kasus2s','kasus2s.id_rw','=','rws.id')
//         ->sum('kasus2s.jumlah_sembuh');

//         $meninggal = DB::table('rws')->select('kasus2s.jumlah_positif','kasus2s.jumlah_sembuh','kasus2s.jumlah_meninggal')
//         ->join('kotas','kotas.id_provinsi','=','provinsis.id')
//         ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
//         ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
//         ->join('rws','rws.id_kelurahan','=','kelurahans.id')
//         ->join('kasus2s','kasus2s.id_rw','=','rws.id')
//         ->sum('kasus2s.jumlah_meninggal');

//         $provv = provinsi::findOrFail($id);

//         $res = [
//             'success' => true,
//             'Data' => 'Data Kasus provinsi',
//             'Nama Preovinsi' => $prov,
//             'jumlah Positif' => $positif,
//             'Jumlah Sembuh' => $sembuh,
//             'jumlah Meninggal' => $meninggal,
//             'message' => 'Data Kasus Di tampilkan'
//         ];
// return response()->json($res,200);
    
    
        //     $provinsi = provinsi::whereId($id)->first();
     
    //  if($provinsi){
    //      return response()->json([
    //          'success' => true,
    //          'data' => $provinsi,
    //          'message' => 'Detail Provinsi'
    //      ],200);
    //  } else {
    //     return response()->json([
    //     'success' => false,
    //     'data' => '',
    //     'message' => 'provinsi tidak di temukan'
    // ],200);
    //  }

    //   return response()->json($provinsi,200);
    }
// mENAMPILKAN DATA PROVINSI MENURUT ID
    public function provinsi($id)
    {
        $tampil = DB::table('provinsis')
        ->join('kotas','kotas.id_provinsi','=','provinsis.id')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('kasus2s','kasus2s.id_rw','=','rws.id')
        ->where('provinsis.id',$id)
        ->select('nama_provinsi',
        DB::raw('sum(kasus2s.jumlah_positif) as jumlah_positif'),
        DB::raw('sum(kasus2s.jumlah_sembuh) as jumlah_sembuh'),
        DB::raw('sum(kasus2s.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_provinsi')
        ->get();

        $data = [
            'success' => true,
            'Data Provinsi' => $tampil,
            'message' => 'Data Kasus Di tampilkan'
        ];
return response()->json($data,200);


    }

    
    public function edit($id)
    {
        //
    }

    
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    
    public function destroy($id)
    {
        $provinsi = provinsi::findOrFail($id);
        $provinsi->delete();
    if($provinsi){
        return response()->json([ 
            'success' => true,
            'message' => 'data berhasil dihapus',
        ],500);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'data gagal dihapus',

        ],500);
    }
        
    }
}