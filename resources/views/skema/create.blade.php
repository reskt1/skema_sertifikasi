@extends('layouts.app')

@section('title', 'Tambah Skema')

@section('content')

<h1>Tambah Skema</h1>

<div class="form-container">

    <h2>Form Tambah Skema</h2>

    <form
        action="{{ route('skema.store') }}"
        method="POST"
    >

        @csrf

        {{-- NAMA SKEMA --}}

        <div class="form-group">

            <label for="nama_skema">
                Nama Skema
            </label>

            <input
                type="text"
                id="nama_skema"
                name="nama_skema"
                value="{{ old('nama_skema') }}"
                required
            >

            @error('nama_skema')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- KODE SKEMA --}}

        <div class="form-group">

            <label for="kode_skema">
                Kode Skema
            </label>

            <input
                type="text"
                id="kode_skema"
                name="kode_skema"
                value="{{ old('kode_skema') }}"
                required
            >

            @error('kode_skema')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- DESKRIPSI --}}

        <div class="form-group">

            <label for="deskripsi">
                Deskripsi
            </label>

            <textarea
                id="deskripsi"
                name="deskripsi"
                rows="5"
            >{{ old('deskripsi') }}</textarea>

            @error('deskripsi')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- TOMBOL --}}

        <div class="form-actions">

            <a
                href="{{ route('skema.index') }}"
                class="button cancel"
            >
                Batal
            </a>

            <button
                type="submit"
                class="button save"
            >
                Simpan
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
