@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

@if(session('success'))
    <div class="alert-success-custom">
        {{ session('success') }}
    </div>
@endif

<div class="profile-card">
    <div class="profile-header">
        <h2>Profil Kompetensi Saya</h2>
        @if($peserta->status_verifikasi == 'pending')
            <span class="badge pending">PENDING (Menunggu Verifikasi)</span>
        @elseif($peserta->status_verifikasi == 'diverifikasi')
            <span class="badge verified">DIVERIFIKASI</span>
        @else
            <span class="badge rejected">DITOLAK</span>
        @endif
    </div>

    <!-- TAMPILAN DETAIL BERSIH (TANPA FORM INPUT) -->
    <div class="detail-item">
        <span class="label">NIK</span>
        <span>{{ $peserta->nik }}</span>
    </div>

    <div class="detail-item">
        <span class="label">Nama Lengkap</span>
        <span>{{ $peserta->nama }}</span>
    </div>

    <div class="detail-item">
        <span class="label">Email Akun</span>
        <span>{{ $peserta->email }}</span>
    </div>

    <div class="detail-item">
        <span class="label">Nomor HP / WhatsApp</span>
        <span>{{ $peserta->no_hp }}</span>
    </div>

    <div class="detail-item">
        <span class="label">Skema Sertifikasi</span>
        <span>{{ $peserta->skema->nama_skema ?? '-' }}</span>
    </div>

    <div class="detail-item">
        <span class="label">Alamat Rumah</span>
        <span>{{ $peserta->alamat ?? '-' }}</span>
    </div>

    <!-- TOMBOL UNTUK MENUJU HALAMAN EDIT -->
    <div class="form-actions">
        <a href="{{ route('peserta.profile.profile_edit') }}" class="button edit-btn">
            ✏️ Edit Profil Saya
        </a>
    </div>
</div>

<style>
    .profile-card {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        max-width: 750px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }
    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    .profile-header h2 { margin: 0; font-size: 22px; color: #333; }

    .detail-item {
        display: flex;
        padding: 14px 0;
        border-bottom: 1px solid #eee;
        font-size: 15px;
    }
    .detail-item:last-of-type { border-bottom: none; }
    .label { font-weight: bold; width: 200px; color: #555; flex-shrink: 0; }

    .badge { padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; }
    .pending { background-color: #ffc107; color: #000; }
    .verified { background-color: #198754; color: white; }
    .rejected { background-color: #dc3545; color: white; }

    .form-actions { display: flex; justify-content: flex-end; margin-top: 25px; }
    .edit-btn {
        background-color: #333;
        color: white;
        text-decoration: none;
        padding: 11px 20px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
        transition: background-color 0.2s;
    }
    .edit-btn:hover { background-color: #555; }

    .alert-success-custom {
        background-color: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 6px;
        margin-bottom: 20px; max-width: 750px; font-size: 14px; border-left: 5px solid #0f5132;
    }
</style>
@endsection
