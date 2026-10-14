<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);


        if(Auth::attempt($credentials)){
        $request->session()->regenerate();

        // ---- PROSES PENGALIHAN BERDASARKAN ROLE (GANTIKAN BARIS SEBELUMNYA) ----
        $user = Auth::user(); // Ambil data user yang baru saja sukses login

        if ($user->role === 'admin') {
            // Jika admin, lempar ke rute dashboard admin
            return redirect()->route('dashboard');
        } else {
            // Jika peserta, lempar ke rute profil peserta
            return redirect()->route('peserta.profile');
        }
        // -----------------------------------------------------------------------
    }

        return back()->withErrors([
            'email'=>'Email atau password salah.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    public function showRegister(){
        $skemas = Skema::all();
        return view('auth.register', compact('skemas'));
    }
   public function register(Request $request)
    {
        // 1. Validasi Input Gabungan
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nik'      => 'required|string|size:16|unique:pesertas',
            'no_hp'    => 'required|string',
            'alamat'   => 'nullable|string',
            'skema_id' => 'required|exists:skemas,id',
        ]);

        // 2. Insert ke Tabel Users (Untuk Akun Login)
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'peserta', // Default role akun baru sebagai peserta
        ]);

        // 3. Insert ke Tabel Pesertas (Otomatis Terkoneksi dengan user_id baru)
        Peserta::create([
            'user_id'           => $user->id, // Mengikat data peserta ke ID user di atas
            'skema_id'          => $request->skema_id,
            'nik'               => $request->nik,
            'nama'              => $request->name,
            'email'             => $request->email,
            'no_hp'             => $request->no_hp,
            'alamat'            => $request->alamat,
            'status_verifikasi' => 'pending', // Default status awal menunggu admin
        ]);

        // 4. Otomatis login menggunakan user yang baru didaftarkan
        Auth::login($user);

        // 5. Alihkan ke halaman profil peserta (Sesuai Cara ke-2 yang kita pilih)
        return redirect()->route('peserta.profile')->with('success', 'Registrasi sukses! Silakan periksa data profil Anda.');
    }
}
