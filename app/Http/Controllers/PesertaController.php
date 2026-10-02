<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query =Peserta::with('skema');
        if($request->filled('search')){
            $search = $request->search;

            $query->where(function ($q) use ($search){
                $q->where('nama','like', "%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->orWhere('no_hp','like',"%{$search}%")
                ->orWhereHas('skema', function($q) use ($search){
                    $q->where('nama_skema','like',"%{$search}%");
                });
            });
        }

        $pesertas = $query->latest()->get();

        return view('peserta.index', compact('pesertas'));
    }

    public function create()
    {
        $skemas = Skema::all();

        return view('peserta.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'skema_id' => 'required|exists:skemas,id',
            'nik' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        Peserta::create($validated);

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function show(Peserta $peserta)
    {
        $peserta->load('skema');

        return view('peserta.show', compact('peserta'));
    }

    public function edit(Peserta $peserta)
    {
        $skemas = Skema::all();

        return view('peserta.edit', compact('peserta', 'skemas'));
    }

    public function update(Request $request, Peserta $peserta)
    {
        $validated = $request->validate([
            'skema_id' => 'required|exists:skemas,id',
            'nik' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $peserta->update($validated);

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Peserta berhasil diperbarui.');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Peserta berhasil dihapus.');
    }
}
