<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use carbon\carbon;
use App\Models\rw;
use App\Models\kasus2;

class UtamaController extends Controller
{
    public function index()
    {
        $positif = DB::table('rws')
    ->select('kasus2s.jumlah_positif',
    'kasus2s.jumlah_sembuh', 'kasus2s.jumlah_meninggal')
    ->join('kasus2s','rws.id','=','kasus2s.id_rw')
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

$tanggal = Carbon::now()->format('D d-M-Y');

    return view('utama',compact('positif','sembuh','meninggal','tanggal'));
    }   
}
