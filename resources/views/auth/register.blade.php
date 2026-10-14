@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="register-container">
    <div class="register-card">
        <h2>Register</h2>
        <p class="subtitle">Silahkan Registrasi Akun Anda</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="section-title">Informasi Akun Login</div>

            <!-- Nama Lengkap -->
            <div class="form-item">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="input-field" required value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
            </div>

            <!-- Email -->
            <div class="form-item">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="input-field" required value="{{ old('email') }}" placeholder="Masukkan email">
            </div>

            <!-- Password & Konfirmasi -->
            <div class="form-row">
                <div class="form-item flex-1">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="input-field" required placeholder="Masukkan password">
                </div>
                <div class="form-item flex-1">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" required placeholder="Ulangi password">
                </div>
            </div>

            <div class="section-title border-top">Data Kompetensi Peserta</div>

            <!-- NIK & No HP -->
            <div class="form-row">
                <div class="form-item flex-1">
                    <label for="nik">NIK (16 Digit)</label>
                    <input type="text" id="nik" name="nik" class="input-field" maxlength="16" required value="{{ old('nik') }}" placeholder="Masukkan NIK">
                </div>
                <div class="form-item flex-1">
                    <label for="no_hp">Nomor HP / WhatsApp</label>
                    <input type="text" id="no_hp" name="no_hp" class="input-field" required value="{{ old('no_hp') }}" placeholder="Masukkan nomor HP">
                </div>
            </div>

            <!-- Pilih Skema -->
            <div class="form-item">
                <label for="skema_id">Pilih Skema Sertifikasi</label>
                <select id="skema_id" name="skema_id" class="input-field select-field" required>
                    <option value="">-- Pilih Skema --</option>
                    @foreach($skemas as $skema)
                        <option value="{{ $skema->id }}" {{ old('skema_id') == $skema->id ? 'selected' : '' }}>
                            {{ $skema->nama_skema }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Alamat Rumah -->
            <div class="form-item">
                <label for="alamat">Alamat Rumah</label>
                <textarea id="alamat" name="alamat" class="input-field textarea-field" rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
            </div>

            <!-- Tombol Submit -->
            <div class="form-actions">
                <button type="submit" class="submit-btn">
                    Register
                </button>
            </div>

            <!-- Footer mengikuti keseimbangan kanan-kiri halaman login Anda -->
            <div class="register-footer">
                <a href="/" class="back-link">← Kembali</a>
                <a href="{{ route('login') }}" class="login-link">Belum punya akun?</a>
            </div>
        </form>
    </div>
</div>

<style>
    body {
        background-color: #f4f7f9 !important; /* Latar belakang abu kebiruan lembut seperti login */
    }

    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 0;
        width: 100%;
    }

    .register-card {
        background-color: white;
        padding: 40px;
        border-radius: 10px;
        width: 100%;
        max-width: 540px; /* Diperkecil sedikit agar proporsinya pas mirip card login */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid #eef2f5;
    }

    .register-card h2 {
        margin-top: 0;
        margin-bottom: 6px;
        color: #000;
        font-size: 26px;
        font-weight: bold;
        text-align: center; /* Judul rata tengah seperti login */
    }

    .subtitle {
        color: #777;
        font-size: 13px;
        margin-bottom: 30px;
        text-align: center; /* Subtitle rata tengah seperti login */
    }

    .section-title {
        font-weight: bold;
        font-size: 14px;
        color: #555;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .border-top {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .form-item {
        display: flex;
        flex-direction: column;
        margin-bottom: 16px;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .flex-1 {
        flex: 1;
    }

    .form-item label {
        font-size: 13px;
        margin-bottom: 8px;
        color: #333;
    }

    .input-field {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        color: #333;
        width: 100%;
        transition: border-color 0.2s;
    }

    .input-field::placeholder {
        color: #ccc;
        font-size: 13px;
    }

    .input-field:focus {
        border-color: #528fb3; /* Fokus border warna biru login */
        outline: none;
    }

    .select-field {
        background-color: white;
        height: 38px;
    }

    .textarea-field {
        resize: vertical;
        font-family: inherit;
    }

    .form-actions {
        margin-top: 25px;
    }

    .submit-btn {
        width: 100%;
        background-color: #528fb3; /* Warna biru baja tombol login Anda */
        color: white;
        border: none;
        padding: 11px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: normal;
        cursor: pointer;
        text-align: center;
        transition: background-color 0.2s;
    }

    .submit-btn:hover {
        background-color: #437a9c;
    }

    .register-footer {
        display: flex;
        justify-content: space-between; /* Tata letak kanan-kiri seimbang seperti login */
        margin-top: 25px;
        font-size: 13px;
    }

    .register-footer .back-link {
        color: #528fb3;
        text-decoration: none;
    }

    .register-footer .login-link {
        color: #528fb3;
        font-weight: bold;
        text-decoration: none;
    }

    .register-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 600px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }
</style>
@endsection
