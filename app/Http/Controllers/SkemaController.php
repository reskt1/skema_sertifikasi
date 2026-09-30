<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{

    public function index()
    {
        $skemas = Skema::with('pesertas')->latest()->get();

        return view('skema.index', compact('skemas'));
    }


    public function create()
    {
        return view('skema.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_skema' => 'required|string|max:255',
            'kode_skema' => 'required|string|max:100|unique:skemas,kode_skema',
            'deskripsi' => 'nullable|string',
        ]);

        Skema::create($validated);

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema berhasil ditambahkan.');
    }


    public function show(Skema $skema)
    {
         $skema->load('pesertas');

        return view('skema.show', compact('skema'));
    }


    public function edit(Skema $skema)
    {
        return view('skema.edit', compact('skema'));
    }


    public function update(Request $request, Skema $skema)
    {
        $validated = $request->validate([
            'nama_skema' => 'required|string|max:255',
            'kode_skema' => 'required|string|max:100|unique:skemas,kode_skema,' . $skema->id,
            'deskripsi' => 'nullable|string',
        ]);

        $skema->update($validated);

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema berhasil diperbarui.');
    }


    public function destroy(Skema $skema)
    {
        $skema->delete();

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema berhasil dihapus.');
    }
}
