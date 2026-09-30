@extends('layouts.app')

@section('title', 'Data Skema')

@section('content')

<h1>Data Skema</h1>

{{-- PESAN SUKSES --}}

@if (session('success'))

    <div class="alert-success">
        {{ session('success') }}
    </div>

@endif


{{-- HEADER HALAMAN --}}

<div class="page-header">

    <div>
        <h2>Daftar Skema Sertifikasi</h2>

        <p>
            Data skema sertifikasi yang tersedia.
        </p>
    </div>

    <a
        href="{{ route('skema.create') }}"
        class="button"
    >
        + Tambah Skema
    </a>

</div>


{{-- TABEL SKEMA --}}

<div class="table-container">

    <table>

        <thead>

            <tr>
                <th>No</th>
                <th>Nama Skema</th>
                <th>Kode Skema</th>
                <th>Jumlah Peserta</th>
                <th>Aksi</th>
            </tr>

        </thead>

        <tbody>

            @forelse ($skemas as $skema)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $skema->nama_skema }}
                    </td>

                    <td>
                        {{ $skema->kode_skema }}
                    </td>

                    <td>
                        {{ $skema->pesertas->count() }} peserta
                    </td>

                    <td class="actions">

                        <a
                            href="{{ route('skema.show', $skema) }}"
                            class="button detail"
                        >
                            Detail
                        </a>

                        <a
                            href="{{ route('skema.edit', $skema) }}"
                            class="button edit"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('skema.destroy', $skema) }}"
                            method="POST"
                            style="display: inline;"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="button delete"
                                onclick="return confirm('Yakin ingin menghapus skema ini?')"
                            >
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="empty">
                        Belum ada data skema.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


{{-- CSS KHUSUS HALAMAN SKEMA --}}

<style>

    .alert-success {
        background-color: #d4edda;
        color: #155724;

        padding: 12px 15px;

        border-radius: 6px;

        margin-bottom: 20px;
    }

    .page-header {
        background-color: white;

        padding: 20px 25px;

        border-radius: 10px;

        margin-bottom: 20px;

        display: flex;

        justify-content: space-between;

        align-items: center;

        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .page-header h2 {
        margin: 0 0 5px 0;
    }

    .page-header p {
        margin: 0;

        color: #666;
    }

    .button {
        display: inline-block;

        padding: 8px 12px;

        border: none;

        border-radius: 5px;

        text-decoration: none;

        cursor: pointer;

        font-size: 14px;

        background-color: #333;

        color: white;
    }

    .button:hover {
        opacity: 0.8;
    }

    .detail {
        background-color: #555;
    }

    .edit {
        background-color: #777;
    }

    .delete {
        background-color: #333;
    }

    .table-container {
        background-color: white;

        padding: 20px;

        border-radius: 10px;

        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);

        overflow-x: auto;
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

    .actions {
        white-space: nowrap;
    }

    .empty {
        text-align: center;

        color: #777;

        padding: 30px;
    }

    @media (max-width: 700px) {

        .page-header {
            flex-direction: column;

            align-items: flex-start;

            gap: 15px;
        }

    }

</style>

@endsection
