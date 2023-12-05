<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class BookService{
    public function tambahBuku($title, $category, $penulis, $jumlahDitambahkan) {
        $title = ucwords($title);
        $penulis = ucwords($penulis);
        $category = ucwords($category);
        $table = DB::table('books')->where('title', $title)->where('category', $category)->where('penulis', $penulis);
        if($table->exists()){
            $update = DB::update('UPDATE books SET jumlah_tersedia = jumlah_tersedia + ?', [$jumlahDitambahkan]);
            return $update>0;
        }
        $insert = DB::insert('INSERT INTO books (title, category, penulis, jumlah_tersedia) VALUES (?, ?, ?, ?)', [$title, $category, $penulis, $jumlahDitambahkan]);
        return $insert>0;
    }

    public function updateJumlahBuku($id, $jumlah){
        $table = DB::table('books')->where('id', $id);
        if($table->count()>0){
            $update = $table->update(['jumlah_tersedia' => $jumlah]);
            return $update>0;
        }
        return false;
    }

    public function pinjamBuku($buku_id, $user_name){
        $peminjaman = DB::table('peminjaman')->where('book_id', $buku_id)->exists();
        $table_book = DB::table('books')->where('id', $buku_id);
        if($peminjaman){
            return false;
        }
        if($table_book->doesntExist()){
            return false;
        }

        if($table_book->value('jumlah_tersedia') < 1){
            return false;
        }
        if($table_book->exists()){
            $tambah = DB::insert('INSERT INTO peminjaman (user_name, book_id, is_confirmed, tanggal_peminjaman) VALUES (?, ?, ?, ?)', [$user_name, $buku_id, false, date("Y-m-d")]);

            return $tambah>0;
        }
    }
}