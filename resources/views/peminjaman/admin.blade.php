@extends('layouts.navbar')

@section('container')

{{-- @include('layouts.alert', ['pesan' => $pesan, 'style' =>$style]); --}}

<div class="container">
    <h2>Peminjaman</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Judul Buku</th>
        <th scope="col">Peminjam</th>
        <th scope="col">Tanggal peminjaman</th>
        <th scope="col">Aksi</th>
    </tr>
    </thead>
    <tbody>
        @php
            $i=0
        @endphp
    @foreach ($peminjaman as $data)
    <tr>
        <th scope="row">{{++$i}}</th>
        <td>{{$data->title}}</td>
        <td>{{$data->user_name}}</td>
        <td>{{$data->tanggal_peminjaman}}</td>
        <td>
            <button type="button" class="btn btn-success" onclick="return confirm('Setujui Peminjaman ini?')">
                <a href="confirm/{{$data->book_id}}" class="link-body-emphasis">Setujui</a>
            </button>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>
</div>

@endsection