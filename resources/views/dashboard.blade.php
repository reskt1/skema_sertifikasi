@extends('layouts.app') @section('title', 'Dashboard') @section('content') <h1>Dashboard</h1> <!-- WELCOME -->
<div class="welcome">
    <h2> Selamat Datang, {{ Auth::user()->name }} </h2>
    <p> Berikut adalah ringkasan data sistem sertifikasi. </p>
</div> <!-- SUMMARY -->
<div class="summary">
    <div class="summary-card">
        <h3>Total Skema</h3>
        <div class="summary-number"> {{ $jumlahSkema }} </div> <a href="{{ route('skema.index') }}"> Lihat Data Skema →
        </a>
    </div>
    <div class="summary-card">
        <h3>Total Peserta</h3>
        <div class="summary-number"> {{ $jumlahPeserta }} </div> <a href="{{ route('peserta.index') }}"> Lihat Data
            Peserta → </a>
    </div>
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
    }

    .summary {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .summary-card {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .summary-card h3 {
        margin-top: 0;
        color: #666;
    }

    .summary-number {
        font-size: 36px;
        font-weight: bold;
        margin: 10px 0;
    }

    .summary-card a {
        color: #333;
        text-decoration: none;
    }

    @media (max-width: 700px) {
        .summary {
            grid-template-columns: 1fr;
        }
    }
</style> @endsection
