@extends('layouts.app')

@section('title', 'Edit Peserta')

@section('content')

<h1>Edit Peserta</h1>

<div class="form-container">

    <h2>Form Edit Peserta</h2>

    <form
        action="{{ route('peserta.update', $peserta) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        {{-- SKEMA --}}

        <div class="form-group">

            <label for="skema_id">
                Skema Sertifikasi
            </label>

            <select
                id="skema_id"
                name="skema_id"
                required
            >

                <option value="">
                    -- Pilih Skema --
                </option>

                @foreach ($skemas as $skema)

                    <option
                        value="{{ $skema->id }}"
                        {{ old('skema_id', $peserta->skema_id) == $skema->id ? 'selected' : '' }}
                    >
                        {{ $skema->nama_skema }}
                    </option>

                @endforeach

            </select>

            @error('skema_id')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        {{-- NIK --}}

        <div class="form-group">

            <label for="nama">
                NIK
            </label>

            <input
                type="text"
                id="nik"
                name="nik"
                value="{{ old('nik', $peserta->nik) }}"
                required
            >

            @error('nik')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        {{-- NAMA --}}

        <div class="form-group">

            <label for="nama">
                Nama Peserta
            </label>

            <input
                type="text"
                id="nama"
                name="nama"
                value="{{ old('nama', $peserta->nama) }}"
                required
            >

            @error('nama')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- EMAIL --}}

        <div class="form-group">

            <label for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $peserta->email) }}"
                required
            >

            @error('email')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- NO HP --}}

        <div class="form-group">

            <label for="no_hp">
                Nomor HP
            </label>

            <input
                type="text"
                id="no_hp"
                name="no_hp"
                value="{{ old('no_hp', $peserta->no_hp) }}"
                required
            >

            @error('no_hp')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- ALAMAT --}}

        <div class="form-group">

            <label for="alamat">
                Alamat
            </label>

            <textarea
                id="alamat"
                name="alamat"
                rows="5"
                required
            >{{ old('alamat', $peserta->alamat) }}</textarea>

            @error('alamat')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- TOMBOL --}}

        <div class="form-actions">

            <a
                href="{{ route('peserta.index') }}"
                class="button cancel"
            >
                Batal
            </a>

            <button
                type="submit"
                class="button save"
            >
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>


<style>

    .form-container {
        background-color: white;

        padding: 25px;

        border-radius: 10px;

        max-width: 700px;

        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .form-container h2 {
        margin-top: 0;

        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;

        margin-bottom: 7px;

        font-weight: bold;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;

        padding: 10px;

        border: 1px solid #ccc;

        border-radius: 5px;

        font-family: Arial, sans-serif;

        font-size: 14px;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;

        border-color: #555;
    }

    .error {
        color: #b00020;

        font-size: 13px;

        margin-top: 5px;
    }

    .form-actions {
        display: flex;

        gap: 10px;

        margin-top: 25px;
    }

    .button {
        display: inline-block;

        padding: 10px 16px;

        border: none;

        border-radius: 5px;

        text-decoration: none;

        cursor: pointer;

        font-size: 14px;
    }

    .cancel {
        background-color: #ddd;

        color: #333;
    }

    .save {
        background-color: #333;

        color: white;
    }

    .button:hover {
        opacity: 0.8;
    }

</style>

@endsection
