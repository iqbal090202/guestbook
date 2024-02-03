@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Tambah Tamu</h1>
        <form action="{{ route('guest.store') }}" method="POST">
            @csrf

            <div class="form-group mb-2">
                <label for="name">Nama*:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group mb-2">
                <label for="email">Email*:</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group mb-2">
                <label for="address">Alamat:</label>
                <textarea name="address" id="address" class="form-control"></textarea>
            </div>

            <a type="button" href="{{ route('guest.index') }}" class="btn btn-secondary mt-2 me-2">Kembali</a>
            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        </form>
    </div>
@endsection
