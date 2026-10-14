@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<!-- NOTIFIKASI SUKSES SETELAH VERIFIKASI -->
@if(session('success'))
    <div class="alert-success-custom">
        {{ session('success') }}
    </div>
@endif

<!-- WELCOME PANEL -->
<div class="welcome">
    <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
    <p>Berikut adalah antrean pengajuan sertifikasi masuk yang membutuhkan tindakan verifikasi Anda.</p>
</div>

<!-- DATA TABEL ANTREAN RINGKAS -->
<div class="table-container">
    <div class="table-title">⚡ Antrean Verifikasi Pengajuan</div>
    <table>
        <thead>
            <tr>
                <th style="width: 60px;">No</th>
                <th>Nama Peserta</th>
                <th>Skema Sertifikasi</th>
                <th style="width: 250px; text-align: center;">Aksi Persetujuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesertas->where('status_verifikasi', 'pending') as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="candidate-name">{{ $p->nama }}</td>
                <td>{{ $p->skema->nama_skema ?? 'Belum memilih skema' }}</td>
                <td class="actions" style="text-align: center;">
                    <!-- Tombol Setujui -->
                    <form action="{{ route('admin.peserta.verifikasi', $p->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="diverifikasi">
                        <button type="submit" class="button-action verify-btn" onclick="return confirm('Setujui registrasi peserta ini?')">
                            ✓ Setujui
                        </button>
                    </form>

                    <!-- Tombol Tolak -->
                    <form action="{{ route('admin.peserta.verifikasi', $p->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="ditolak">
                        <button type="submit" class="button-action reject-btn" onclick="return confirm('Tolak registrasi peserta ini?')">
                            ✕ Tolak
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="empty">🎉 Bersih! Semua pengajuan pendaftaran peserta telah selesai diproses.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
    .welcome {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
    }

    .welcome h2 {
        margin-top: 0;
        margin-bottom: 8px;
        color: #333;
    }

    .welcome p {
        margin: 0;
        color: #666;
        font-size: 14px;
    }

    .table-container {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .table-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
        padding-bottom: 8px;
        border-bottom: 2px solid #eee;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 14px;
    }

    th, td {
        padding: 14px 15px;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: bold;
    }

    tr:hover {
        background-color: #fcfcfc;
    }

    .candidate-name {
        font-weight: bold;
        color: #247bad;
    }

    .empty {
        text-align: center;
        color: #198754;
        font-weight: bold;
        padding: 30px;
        font-size: 15px;
        background-color: #f0fdf4;
        border-radius: 5px;
    }

    /* BUTTONS VERIFIKASI */
    .actions {
        white-space: nowrap;
    }

    .button-action {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 5px;
        font-size: 13px;
        font-weight: bold;
        cursor: pointer;
        border: none;
        margin: 0 4px;
        transition: transform 0.1s, opacity 0.2s;
    }

    .button-action:hover {
        opacity: 0.9;
        transform: scale(1.02);
    }

    .verify-btn {
        background-color: #198754;
        color: white;
    }

    .reject-btn {
        background-color: #dc3545;
        color: white;
    }

    /* NOTIFIKASI */
    .alert-success-custom {
        background-color: #d1e7dd;
        color: #0f5132;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
        border-left: 5px solid #0f5132;
        font-weight: bold;
    }
</style>
@endsection
