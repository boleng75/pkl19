<?php

namespace App\Http\Controllers;
use App\Http\Controller\DB;
use App\Models\kecamatan;
use App\Models\kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    
    public function index()
    {
        $kelurahan = kelurahan::with('kecamatan')->get();
        return view('kelurahan.index', compact('kelurahan'));
    }

    
    public function create()
    {
        $kecamatan = kecamatan::all();
        return view ('kelurahan.create', compact('kecamatan'));
    }

    
    public function store(Request $request)
    {
        $kelurahan = new kelurahan;
        $kelurahan->id_kecamatan = $request->id_kecamatan;
        $kelurahan->kode_kelurahan = $request->kode_kelurahan;
        $kelurahan->nama_kelurahan = $request->nama_kelurahan;
        $kelurahan->save();
        return redirect()->route('kelurahan.index')->with(['message' => 'Data kelurahan Berhasil disimpan']);
    }

    
    public function show($id)
    {
        $kelurahan = kelurahan::findOrFail($id);
        return view('kelurahan.show', compact('kelurahan'));
    }

    
    public function edit($id)
    {
        $kelurahan = kelurahan::findOrFail($id);
        $kecamatan = kecamatan::all();
        return view('kelurahan.edit', compact('kelurahan', 'kecamatan'))->with(['message' => 'Data kelurahan Berhasil diedit']);
    }

    
    public function update(Request $request,$id)
    {
        $kelurahan = kelurahan::findOrFail($id);
        $kelurahan->id_kecamatan = $request->id_kecamatan;
        $kelurahan->kode_kelurahan = $request->kode_kelurahan;
        $kelurahan->nama_kelurahan = $request->nama_kelurahan;
        $kelurahan->save();
        return redirect()->route('kelurahan.index')->with(['message' => 'Data kelurahan Berhasil disimpan']);
    }

    
    public function destroy($id)
    {
        $kelurahan = kelurahan::findOrFail($id)->delete();
        return redirect()->route('kelurahan.index')->with(['message' => 'Data Berhasil dihapus']);
    }
}
