<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // 1. Fungsi untuk menampilkan Dashboard Admin beserta data peserta
    public function index()
    {
        // Keamanan: Pastikan hanya user dengan role admin yang bisa masuk
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini khusus Admin.');
        }

        // Mengambil data peserta dari database
        $pesertas = \App\Models\Peserta::latest()->get();

        // KARENA FILE ADA DI LUAR: Cukup panggil 'dashboard', bukan 'admin.dashboard'
        return view('dashboard', compact('pesertas'));
    }

    public function edit()
    {
        if (Auth::user()->role !== 'peserta') {
            abort(403);
        }
        // Ambil data peserta yang sedang login
        $peserta = Peserta::where('user_id', Auth::user()->id)->first();

        return view('peserta.profile_edit', compact('peserta'));
    }

    // Fungsi untuk memproses Tombol Verifikasi (Setujui / Tolak)
    public function verifikasi(Request $request, int $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Cari data peserta berdasarkan ID yang diklik
        $peserta = Peserta::findOrFail($id);

        // Validasi input status, memastikan hanya menerima data 'diverifikasi' atau 'ditolak'
        $request->validate([
            'status' => 'required|in:diverifikasi,ditolak'
        ]);

        // Update status_verifikasi di database
        $peserta->update([
            'status_verifikasi' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status verifikasi peserta berhasil diperbarui!');
    }
}
