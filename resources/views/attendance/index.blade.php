@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="container">
            <div class="alert alert-success">{{ session('success') }}</div>
        </div>
    @endif
    {{-- <div class="container d-flex justify-content-end">
        <a href="{{ route('guest.create') }}" class="btn btn-primary">Tambah Tamu</a>
    </div> --}}
    <div class="container">
        <h1>Daftar Kehadiran</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tamu</th>
                    <th>Pesan</th>
                    <th>Waktu Tiba</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td> {{ $data->id }} </td>
                        <td> {{ $data->guest->name }} </td>
                        <td> {{ $data->message }} </td>
                        <td> {{ $data->arrival }} </td>
                        <td class="d-flex">
                            {{-- <a href="{{ route('attendance.index', $data->id) }}" class="btn btn-primary me-1"><i class="bi bi-pen"></i></a> --}}
                            <form action="{{ route('attendance.destroy', $data->id) }}" method="POST">
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
