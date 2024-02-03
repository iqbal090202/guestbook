@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="container">
            <div class="alert alert-success">{{ session('success') }}</div>
        </div>
    @endif
    @if (session('warning'))
        <div class="container">
            <div class="alert alert-warning">{{ session('warning') }}</div>
        </div>
    @endif
    <div class="container d-flex justify-content-end">
        <a href="{{ route('guest.nonactiveall') }}" class="btn btn-danger me-2">Nonaktif Semua Tamu</a>
        <a href="{{ route('guest.create') }}" class="btn btn-primary">Tambah Tamu</a>
    </div>
    <div class="container">
        <h1>Daftar Tamu</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guests as $guest)
                    <tr>
                        <td> {{ $guest->id }} </td>
                        <td> {{ $guest->name }} </td>
                        <td> {{ $guest->email }} </td>
                        <td> {{ $guest->address }} </td>
                        <td>
                            <div class="badge {{ $guest->status === '0' ? 'bg-danger' : "bg-success" }}">
                                {{ $guest->status === '0' ? 'Nonactive' : "Active" }}
                            </div>
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('guest.edit', $guest->id) }}" class="btn btn-primary me-1"><i class="bi bi-pen"></i></a>
                            <form action="{{ route('guest.destroy', $guest->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
