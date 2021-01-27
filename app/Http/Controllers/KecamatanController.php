<?php

namespace App\Http\Controllers;
use App\Http\Controller\DB;
use App\Models\kecamatan;
use App\Models\kota;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{

    public function index()
    {
        $kecamatan = kecamatan::with('kota')->get();
        return view('kecamatan.index', compact('kecamatan'));
    }


    public function create()
    {
        $kota = kota::all();
        return view ('kecamatan.create', compact('kota'));
    }



    public function store(Request $request)
    {
        $kecamatan = new kecamatan;
        $kecamatan->id_kota = $request->id_kota;
        $kecamatan->kode_kecamatan = $request->kode_kecamatan;
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;
        $kecamatan->save();
        return redirect()->route('kecamatan.index')->with(['message' => 'Data Kecamatan Berhasil disimpan']);
    }


    public function show($id)
    {
        $kecamatan = kecamatan::findOrFail($id);
        return view('kecamatan.show', compact('kecamatan'));
    }


    public function edit($id)
    {
        $kecamatan = kecamatan::findOrFail($id);
        $kota = kota::all();
        return view('kecamatan.edit', compact('kecamatan', 'kota'))->with(['message' => 'Data kecamatan Berhasil diedit']);
    }


    public function update(Request $request,$id)
    {
        $kecamatan = kecamatan::findOrFail($id);
        $kecamatan->id_kota = $request->id_kota;
        $kecamatan->kode_kecamatan = $request->kode_kecamatan;
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;
        $kecamatan->save();
        return redirect()->route('kecamatan.index')->with(['message' => 'Data kecamatan Berhasil disimpan']);
    }


    public function destroy($id)
    {
        $kecamatan = kecamatan::findOrFail($id)->delete();
        return redirect()->route('kecamatan.index')->with(['message' => 'Data Berhasil dihapus']);
    }
}
