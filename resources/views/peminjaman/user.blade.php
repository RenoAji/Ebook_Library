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
        <th scope="col">Penulis</th>
        <th scope="col">Category</th>
        <th scope="col">Jumlah Tersedia</th>
        <th scope="col">Aksi</th>
    </tr>
    </thead>
    <tbody>
        @php
            $i=0
        @endphp
    @foreach ($peminjaman_confirmed as $data)
    <tr>
        <th scope="row">{{++$i}}</th>
        <td>{{$data->title}}</td>
        <td>{{$data->penulis}}</td>
        <td>{{$data->category}}</td>
        <td>{{$data->jumlah_tersedia}}</td>
        <td>
            <button type="button" class="btn btn-primary">Baca</button>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>
</div>

<br>

<div class="container">
   <h2>Peminjaman menunggu konfirmasi dari admin</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Judul Buku</th>
            <th scope="col">Penulis</th>
            <th scope="col">Category</th>
            <th scope="col">Jumlah Tersedia</th>
        </tr>
        </thead>
        <tbody>
            @php
                $i=0
            @endphp
        @foreach ($peminjaman_not_confirmed as $data)
        <tr>
            <th scope="row">{{++$i}}</th>
            <td>{{$data->title}}</td>
            <td>{{$data->penulis}}</td>
            <td>{{$data->category}}</td>
            <td>{{$data->jumlah_tersedia}}</td>
        </tr>
        @endforeach

        </tbody>
    </table>
</div>


@endsection