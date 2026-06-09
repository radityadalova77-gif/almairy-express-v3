<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function index()
    {
        $harga = Harga::latest()->paginate(10);

        return view('backend.harga.index', compact('harga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kota_tujuan' => 'required|string|max:100',
            'pulau_tujuan' => 'required|string|max:100',
            'harga_per_kg' => 'required|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);

        Harga::create($validated);

        return redirect()->route('harga.index')
            ->with('sukses', 'Data harga berhasil ditambahkan');
    }

    public function edit(Harga $harga)
    {
        return view('backend.harga.edit', compact('harga'));
    }

    public function update(Request $request, Harga $harga)
    {
        $validated = $request->validate([
            'kota_tujuan' => 'required|string|max:100',
            'pulau_tujuan' => 'required|string|max:100',
            'harga_per_kg' => 'required|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);
        $harga->update($validated);

        return redirect()->route('harga.index')
            ->with('sukses', 'Data harga berhasil diperbarui');
    }

    public function destroy(Harga $harga)
    {
        $harga->delete();

        return redirect()->route('harga.index')
            ->with('sukses', 'Data harga berhasil dihapus');
    }
}
