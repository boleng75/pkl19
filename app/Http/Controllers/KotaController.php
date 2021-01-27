<?php

namespace App\Http\Controllers;
use App\Http\Controller\DB;
use App\Models\provinsi;
use App\Models\kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    
    public function index()
    {
        $kota = Kota::with('provinsi')->get();
        return view('kota.index', compact('kota'));
    }

    
    public function create()
    {
        $provinsi = provinsi::all();
        return view ('kota.create', compact('provinsi'));
    }

    
    public function store(Request $request)
    {
        $kota = new Kota;
        $kota->id_provinsi = $request->id_provinsi;
        $kota->kode_kota = $request->kode_kota;
        $kota->nama_kota = $request->nama_kota;
        $kota->save();
        return redirect()->route('kota.index')->with(['message' => 'Data Kota Berhasil disimpan']);
    }

    
    public function show($id)
    {
        $kota = Kota::findOrFail($id);
        return view('kota.show', compact('kota'));
    }

    
    public function edit($id)
    {
        $kota = Kota::findOrFail($id);
        $provinsi = Provinsi::all();
        return view('kota.edit', compact('kota', 'provinsi'))->with(['message' => 'Data Kota Berhasil diedit']);
    }

    
    public function update(Request $request,$id)
    {
        $kota = Kota::findOrFail($id);
        $kota->id_provinsi = $request->id_provinsi;
        $kota->kode_kota = $request->kode_kota;
        $kota->nama_kota = $request->nama_kota;
        $kota->save();
        return redirect()->route('kota.index')->with(['message' => 'Data Kota Berhasil disimpan']);
    }

    
    public function destroy($id)
    {
        $kota = kota::findOrFail($id)->delete();
        return redirect()->route('kota.index')->with(['message' => 'Data Berhasil dihapus']);
    }
}
