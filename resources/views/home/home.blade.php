@extends('layouts.navbar')

@section('container')

    {{-- @include('layouts.alert', ['pesan' => $pesan, 'style' => $style]) --}}
    <h1>{{$status}} Home Page</h1>
    <h2>Daftar Buku:</h2>
    <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Penulis</th>
                <th scope="col">Category</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $i=0
                @endphp
            @foreach ($books as $book)
            <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{$book->title}}</td>
                <td>{{$book->penulis}}</td>
                <td>{{$book->category}}</td>
                <td>{{$book->jumlah_tersedia}}</td>
                <td>
                    @include('home.'.$status, ['book' => $book])
                    
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
        @if ($is_admin)
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Buku
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/tambah" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="title">
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="category">
                        </div>

                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis">
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlahDitambahkan">
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
        @endif
@endsection