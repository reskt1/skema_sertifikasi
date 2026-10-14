<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PesertaProfileController extends Controller
{
    // 1. Menampilkan Halaman Profil Peserta
    public function index()
    {
        // Pastikan hanya user ber-role peserta yang bisa masuk
        if (Auth::user()->role !== 'peserta') {
            abort(403, 'Halaman ini hanya untuk Peserta.');
        }

        // Ambil data peserta yang terikat dengan Akun User yang sedang login
        $peserta = Peserta::where('user_id', Auth::user()->id)->first();

        return view('peserta.profile', compact('peserta'));
    }

    // 2. Memproses Update Data Profil Mandiri
    public function update(Request $request, $id)
{
    $peserta = Peserta::findOrFail($id);

    // Keamanan hak akses
    if ($peserta->user_id !== Auth::user()->id) {
        abort(403);
    }

    // PROSES VALIDASI DINAMIS UNTUK MENCEGAH EROR DUPLIKAT NIK SAAT EDIT
    $request->validate([
        'nama'     => 'required|string|max:255',
        'no_hp'    => 'required|string',
        'alamat'   => 'required|string',
        'skema_id' => 'required|exists:skemas,id',
        'nik'      => [
            'required',
            'string',
            'size:16',
            // Artinya: NIK harus unique di tabel pesertas, KECUALI untuk ID peserta ini sendiri
            Rule::unique('pesertas', 'nik')->ignore($peserta->id),
        ],
    ]);

    // Simpan semua pembaruan perubahan data baru dari form ke database
    $peserta->update([
        'nama'     => $request->nama,
        'nik'      => $request->nik,
        'skema_id' => $request->skema_id,
        'no_hp'    => $request->no_hp,
        'alamat'   => $request->alamat,
    ]);

    // Sinkronisasi data nama ke akun login utama
    $peserta->user->update([
        'name' => $request->nama
    ]);

    return redirect()->route('peserta.profile')->with('success', 'Profil Anda berhasil diperbarui!');
}
    public function edit()
{
    if (Auth::user()->role !== 'peserta') {
        abort(403);
    }

    // 1. Ambil data peserta yang sedang login
    $peserta = Peserta::where('user_id', Auth::user()->id)->first();

    // 2. Ambil semua data skema dari database untuk isi dropdown select
    $skemas = Skema::all();

    // 3. Kirim kedua variabel ($peserta dan $skemas) ke file view profile_edit
    return view('peserta.profile_edit', compact('peserta', 'skemas'));
}
}
