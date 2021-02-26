<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use DB;
use App\Http\Models\Provinsi;
use App\Http\Models\Kota;
use App\Http\Models\Kecamatan;
use App\Http\Models\Kelurahan;
use App\Http\Models\Rw;
use App\Http\Models\Kasus2;
use Illuminate\Support\Carbon;

class FrontendController extends Controller
{

    

    public function index()
    {
        // Count Up
        $positif = DB::table('rws')
            ->select('kasus2s.jumlah_positif',
            'kasus2s.jumlah_sembuh', 'kasus2s.jumlah_meninggal')
            ->sum('kasus2s','rws.id','=','kasus2s.id_rw')
            ->sum('kasus2s.jumlah_positif'); 
        $sembuh = DB::table('rws')
            ->select('kasus2s.jumlah_positif',
            'kasus2s.jumlah_sembuh','kasus2s.jumlah_meninggal')
            ->join('kasus2s','rws.id','=','kasus2s.id_rw')
            ->sum('kasus2s.jumlah_sembuh');
        $meninggal = DB::table('rws')
            ->select('kasus2s.jumlah_positif',
            'kasus2s.jumlah_sembuh','kasus2s.jumlah_meninggal')
            ->join('kasus2s','rws.id','=','kasus2s.id_rw')
            ->sum('kasus2s.jumlah_meninggal');
        // $global = file_get_contents('https://api.kawalcorona.com/positif');
        // $posglobal = json_decode($global, TRUE);

        // Date
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y hh:mm:s');

        // Table Provinsi
        $tampil = DB::table('provinsis')
                  ->join('kotas','kotas.id_provinsi','=','provinsis.id')
                  ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
                  ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
                  ->join('rws','rws.id_kelurahan','=','kelurahans.id')
                  ->join('kasus2s','kasus2s.id_rw','=','rws.id')
                  ->select('nama_provinsi',
                          DB::raw('sum(kasus2s.jumlah_positif) as jumlah_positif'),
                          DB::raw('sum(kasus2s.jumlah_sembuh) as jumlah_sembuh'),
                          DB::raw('sum(kasus2s.jumlah_meninggal) as jumlah_meninggal'))
                  ->groupBy('nama_provinsi')->orderBy('nama_provinsi','ASC')
                  ->get();

        // Table Global
        // $datadunia= file_get_contents("https://api.kawalcorona.com/");
        // $dunia = json_decode($datadunia, TRUE);
            
        return view('front.welcome',compact('positif','sembuh','meninggal','tanggal','tampil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}