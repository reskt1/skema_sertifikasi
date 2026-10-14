@extends('layouts.app')

@section('title', 'Detail Peserta')

@section('content')

{{-- INFORMASI PESERTA --}}
<div class="detail-card">
    <h2>
        {{ $peserta->nama }}
    </h2>

    <div class="detail-item">
        <span class="label">NIK</span>
        <span>{{ $peserta->nik }}</span>
    </div>

    <div class="detail-item">
        <span class="label">Nama</span>
        <span>{{ $peserta->nama }}</span>
    </div>

    <div class="detail-item">
        <span class="label">Email</span>
        <span>{{ $peserta->email }}</span>
    </div>

    <div class="detail-item">
        <span class="label">Nomor HP</span>
        <span>{{ $peserta->no_hp }}</span>
    </div>

    <div class="detail-item">
        <span class="label">Skema Sertifikasi</span>
        <span>{{ $peserta->skema->nama_skema ?? '-' }}</span>
    </div>

    <div class="detail-item">
        <span class="label">Alamat</span>
        <span>{{ $peserta->alamat ?? '-' }}</span>
    </div>

    <!-- TAMBAHAN: Menampilkan Status Verifikasi Akun -->
    <div class="detail-item">
        <span class="label">Status Akun</span>
        <span>
            @if($peserta->status_verifikasi === 'pending')
                <span class="badge pending">PENDING</span>
            @elseif($peserta->status_verifikasi === 'diverifikasi')
                <span class="badge verified">DIVERIFIKASI</span>
            @else
                <span class="badge rejected">DITOLAK</span>
            @endif
        </span>
    </div>
</div>

{{-- TOMBOL --}}
<div class="actions">
    <a href="{{ route('peserta.index') }}" class="button back">
        ← Kembali
    </a>

    <!-- PERBAIKAN PROTEKSI: Tombol muncul jika dia Admin ATAU dia adalah Peserta pemilik data ini -->
    @if(Auth::user()->role === 'admin' || $peserta->user_id === Auth::user()->id)
        <a href="{{ route('peserta.edit', $peserta) }}" class="button edit">
            Edit Peserta
        </a>
    @endif
</div>

<style>
    .detail-card {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 20px;
        max-width: 800px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .detail-card h2 {
        margin-top: 0;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }

    .detail-item {
        display: flex;
        align-items: center; /* Menyelaraskan teks dengan badge status */
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        gap: 20px;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .label {
        font-weight: bold;
        width: 160px;
        flex-shrink: 0;
    }

    /* CSS TAMBAHAN: Styling untuk Badge Status Verifikasi */
    .badge {
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
    }
    .pending {
        background-color: #ffc107;
        color: #000;
    }
    .verified {
        background-color: #198754;
        color: white;
    }
    .rejected {
        background-color: #dc3545;
        color: white;
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .button {
        display: inline-block;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
    }

    .back {
        background-color: #ddd;
        color: #333;
    }

    .edit {
        background-color: #333;
        color: white;
    }

    .button:hover {
        opacity: 0.8;
    }

    @media (max-width: 700px) {
        .detail-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }

        .label {
            width: auto;
        }
    }
</style>

@endsection
