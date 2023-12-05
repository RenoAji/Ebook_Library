@extends('layouts.navbar')
@section('container')
    <div class="m-auto">
        <h2>{{ $book->title }}</h2>
        <form action="" method="post">
            @csrf
            <div class="mb-3">
                <label for="inputJumlah" class="form-label">Stok Buku</label>
                <input type="number" class="form-control" id="inputJumlah" value={{$book->jumlah_tersedia}} name="jumlah">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection