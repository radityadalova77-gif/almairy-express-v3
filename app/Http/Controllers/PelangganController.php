<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::latest()->paginate(10);

        return view('backend.pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('backend.pelanggan.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'nama_kontak'     => 'required',
            'no_hp'           => 'required',
        ]);

        Pelanggan::create($request->all());

        return redirect()
            ->route('pelanggan.index')
            ->with('sukses', 'Pelanggan berhasil ditambahkan');
    }

    public function show(Pelanggan $pelanggan)
    {
        return view('backend.pelanggan.show', compact('pelanggan'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('backend.pelanggan.form', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'nama_kontak'     => 'required',
            'no_hp'           => 'required',
        ]);

        $pelanggan->update($request->all());

        return redirect()
            ->route('pelanggan.index')
            ->with('sukses', 'Data pelanggan diperbarui');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return back()->with('sukses', 'Pelanggan dihapus');
    }
}
