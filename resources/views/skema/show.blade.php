@extends('layouts.app')

@section('title', 'Detail Skema')

@section('content')

<h1>Detail Skema</h1>


{{-- INFORMASI SKEMA --}}

<div class="detail-card">

    <h2>
        {{ $skema->nama_skema }}
    </h2>

    <div class="detail-item">

        <span class="label">
            Kode Skema
        </span>

        <span>
            {{ $skema->kode_skema }}
        </span>

    </div>


    <div class="detail-item">

        <span class="label">
            Deskripsi
        </span>

        <span>
            {{ $skema->deskripsi ?: '-' }}
        </span>

    </div>

</div>


{{-- DAFTAR PESERTA --}}

<div class="peserta-card">

    <h2>
        Peserta yang Mengikuti Skema
    </h2>

    @if ($skema->pesertas->count() > 0)

        <table>

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>No. HP</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($skema->pesertas as $peserta)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $peserta->nama }}
                        </td>

                        <td>
                            {{ $peserta->email }}
                        </td>

                        <td>
                            {{ $peserta->no_hp }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <p class="empty">
            Belum ada peserta yang mengikuti skema ini.
        </p>

    @endif

</div>


{{-- TOMBOL --}}

<div class="actions">

    <a
        href="{{ route('skema.index') }}"
        class="button back"
    >
        ← Kembali
    </a>

    <a
        href="{{ route('skema.edit', $skema) }}"
        class="button edit"
    >
        Edit Skema
    </a>

</div>


<style>

    .detail-card,
    .peserta-card {
        background-color: white;

        padding: 25px;

        border-radius: 10px;

        margin-bottom: 20px;

        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .detail-card h2,
    .peserta-card h2 {
        margin-top: 0;

        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;

        padding: 12px 0;

        border-bottom: 1px solid #eee;

        gap: 20px;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .label {
        font-weight: bold;

        width: 150px;

        flex-shrink: 0;
    }

    table {
        width: 100%;

        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px;

        border-bottom: 1px solid #ddd;

        text-align: left;
    }

    th {
        background-color: #333;

        color: white;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .empty {
        color: #777;
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

            gap: 5px;
        }

        .label {
            width: auto;
        }

        .peserta-card {
            overflow-x: auto;
        }

    }

</style>

@endsection
