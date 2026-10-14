@extends('layouts.app')

@section('title', 'Data Peserta')

@section('content')

{{-- PESAN SUKSES --}}

@if (session('success'))

    <div class="alert-success">
        {{ session('success') }}
    </div>

@endif


{{-- HEADER HALAMAN --}}

<div class="page-header">

    <div>

        <h2>Daftar Peserta</h2>

        <p>
            Data peserta sertifikasi yang terdaftar.
        </p>

    </div>

    @if(Auth::user()->role === 'peserta')
    <a
        href="{{ route('peserta.create') }}"
        class="button"
    >
        + Tambah Peserta
    </a>
    @endif

</div>


{{-- PENCARIAN --}}

<div class="search-container">

    <form
        action="{{ route('peserta.index') }}"
        method="GET"
    >

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama, email, no HP, atau skema..."
        >

        <button
            type="submit"
            class="button search-button"
        >
            Cari
        </button>

        @if (request('search'))

            <a
                href="{{ route('peserta.index') }}"
                class="button reset"
            >
                Reset
            </a>

        @endif

    </form>

</div>


{{-- TABEL PESERTA --}}

<div class="table-container">

    <table>

        <thead>

            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Skema</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

        </thead>

        <tbody>
            @forelse ($pesertas as $peserta)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peserta->nik }}</td>
                    <td>{{ $peserta->nama }}</td>
                    <td>{{ $peserta->email }}</td>
                    <td>{{ $peserta->no_hp }}</td>
                    <td>{{ $peserta->skema->nama_skema ?? '-' }}</td>

                    <!-- MENAMPILKAN TANDA VERIFIKASI -->
                    <td>
                        @if($peserta->status_verifikasi === 'pending')
                            <span class="badge pending" style="background-color: #ffc107; color: #000; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">PENDING</span>
                        @elseif($peserta->status_verifikasi === 'diverifikasi')
                            <span class="badge verified" style="background-color: #198754; color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">DIVERIFIKASI</span>
                        @else
                            <span class="badge rejected" style="background-color: #dc3545; color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">DITOLAK</span>
                        @endif
                    </td>

                    <td class="actions">
                        <!-- Semua Role bisa melihat Detail -->
                        <a href="{{ route('peserta.show', $peserta) }}" class="button detail">
                            Detail
                        </a>

                        @if(Auth::user()->role === 'admin')
                            <!-- Jika admin yang melihat tabel, arahkan ke form edit admin -->
                            <a href="{{ route('peserta.edit', $peserta) }}" class="button edit">Edit</a>
                        @elseif($peserta->user_id === Auth::user()->id)
                            <!-- Jika peserta melihat datanya sendiri, arahkan langsung ke profil edit kustomnya -->
                            <a href="{{ route('peserta.profile.profile_edit') }}" class="button edit">Edit</a>
                        @endif

                        <!-- Hanya Admin yang bisa menghapus data -->
                        @if(Auth::user()->role === 'admin')
                            <form action="{{ route('peserta.destroy', $peserta) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button delete" onclick="return confirm('Yakin ingin menghapus peserta ini?')">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <!-- Diubah ke colspan="8" karena total kolom sekarang ada 8 -->
                    <td colspan="8" class="empty">
                        @if (request('search'))
                            Peserta dengan kata pencarian tersebut tidak ditemukan.
                        @else
                            Belum ada data peserta.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


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

    .search-container {
        background-color: white;

        padding: 15px 20px;

        border-radius: 10px;

        margin-bottom: 20px;

        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .search-container form {
        display: flex;

        gap: 10px;
    }

    .search-container input {
        flex: 1;

        padding: 10px;

        border: 1px solid #ccc;

        border-radius: 5px;

        font-size: 14px;
    }

    .search-container input:focus {
        outline: none;

        border-color: #555;
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

    .search-button {
        background-color: #333;
    }

    .reset {
        background-color: #ddd;

        color: #333;
    }

    .detail {
        background-color: #ffa601;
    }

    .edit {
        background-color: #01ccff;
    }

    .delete {
        background-color:   #ff0101;
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
       background-color: #000000;;

        color: white;
    }

    tr:hover {
        background-color: #9ce5f2;
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

        .search-container form {
            flex-direction: column;
        }

    }

</style>

@endsection
