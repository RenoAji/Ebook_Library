<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\BookService;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    private $book;
    public function __construct(BookService $book){
        $this->book = $book;
    }

    public function pinjam(Request $request, $buku_id){
        $res = $this->book->pinjamBuku($buku_id, $request->session()->get('user'));
        if(!$res){
            return redirect()->route('home', ['pesan' => 'Tidak Bisa', 'style' =>'danger']);
        }
        return redirect()->route('peminjaman', ['pesan' => 'Peminjaman berhasil, tunggu persetujuan dari admin', 'style' =>'success']);
    }

    public function confirmPeminjaman($id_peminjaman){
        $peminjaman = DB::table('peminjaman')
                        ->where('id', $id_peminjaman);
                    
        $buku = DB::table('books')
                ->where('id', $peminjaman->value('book_id'));

        if($buku->value('stok') < 1){
            return redirect()->route('peminjaman', ['pesan' => 'Stok buku habis', 'style' =>'danger']);
        }

        $buku_update = $buku->decrement('jumlah_tersedia');

        $peminjaman_update = $peminjaman
                            ->update(['is_confirmed' => true, 'tanggal_peminjaman_disetujui' => date('Y-m-d')]);
        
        if($peminjaman_update > 0 && $buku_update > 0){
            return redirect()->route('peminjaman', ['pesan' => 'Peminjaman berhasil disetujui', 'style' =>'success']);
        }else{
            return redirect()->route('peminjaman', ['pesan' => 'Peminjaman gagal disetujui', 'style' =>'danger']);
        }
    }
}