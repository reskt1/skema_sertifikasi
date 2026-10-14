@extends('layouts.app')

@section('title', 'Ubah Profil')

@section('content')
<div class="profile-card">
    <div class="profile-header">
        <h2>Ubah Informasi Profil</h2>
        <a href="{{ route('peserta.profile') }}" class="back-link">← Kembali ke Profil</a>
    </div>

    <form action="{{ route('peserta.profile.update', $peserta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Lengkap -->
        <div class="form-item">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="input-field @error('nama') input-error @enderror" value="{{ old('nama', $peserta->nama) }}" required>
            @error('nama') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <!-- NIK (Sekarang BISA DIEDIT untuk mengatasi typo) -->
        <div class="form-item">
            <label for="nik">NIK (16 Digit)</label>
            <input type="text" name="nik" id="nik" class="input-field @error('nik') input-error @enderror" maxlength="16" value="{{ old('nik', $peserta->nik) }}" required>
            <span class="input-help-info">* Harap periksa kembali kesesuaian NIK dengan KTP Anda.</span>
            @error('nik') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <!-- Pilih Skema Sertifikasi (Sekarang BISA DIEDIT/DIGANTI) -->
        <div class="form-item">
            <label for="skema_id">Skema Sertifikasi Yang Diikuti</label>
            <select id="skema_id" name="skema_id" class="input-field select-field" required>
                @foreach($skemas as $skema)
                    <option value="{{ $skema->id }}" {{ old('skema_id', $peserta->skema_id) == $skema->id ? 'selected' : '' }}>
                        {{ $skema->nama_skema }}
                    </option>
                @endforeach
            </select>
            @error('skema_id') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <!-- Nomor HP -->
        <div class="form-item">
            <label for="no_hp">Nomor Handphone / WhatsApp</label>
            <input type="text" name="no_hp" id="no_hp" class="input-field @error('no_hp') input-error @enderror" value="{{ old('no_hp', $peserta->no_hp) }}" required>
            @error('no_hp') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <!-- Alamat Rumah -->
        <div class="form-item">
            <label for="alamat">Alamat Rumah</label>
            <textarea name="alamat" id="alamat" class="input-field textarea-field @error('alamat') input-error @enderror" rows="4" required>{{ old('alamat', $peserta->alamat) }}</textarea>
            @error('alamat') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="button save-btn">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<style>
    .profile-card { background-color: white; padding: 30px; border-radius: 10px; max-width: 750px; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08); }
    .profile-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 15px; margin-bottom: 25px; }
    .profile-header h2 { margin: 0; font-size: 22px; color: #333; }
    .back-link { color: #247bad; text-decoration: none; font-size: 14px; font-weight: bold; }
    .back-link:hover { text-decoration: underline; }

    .form-item { display: flex; flex-direction: column; margin-bottom: 18px; }
    .form-item label { font-weight: bold; font-size: 14px; margin-bottom: 6px; color: #444; }
    .input-field { padding: 10px 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px; color: #333; }
    .input-field:focus { border-color: #333; outline: none; }
    .select-field { background-color: white; height: 40px; }
    .textarea-field { resize: vertical; font-family: inherit; }
    .error-text { font-size: 12px; color: #dc3545; margin-top: 4px; }
    .input-help-info { font-size: 11px; color: #666; margin-top: 4px; }
    .input-error { border-color: #dc3545; }

    .form-actions { display: flex; justify-content: flex-end; margin-top: 25px; }
    .save-btn { background-color: #198754; color: white; border: none; padding: 11px 20px; border-radius: 5px; font-size: 14px; font-weight: bold; cursor: pointer; transition: background-color 0.2s; }
    .save-btn:hover { background-color: #146c43; }
</style>
@endsection
