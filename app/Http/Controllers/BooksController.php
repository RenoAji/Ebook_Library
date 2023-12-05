<?php

namespace App\Http\Controllers;

use App\Service\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    private $book;
    public function __construct(BookService $book){
        $this->book = $book;
    }

    public function tambah(Request $request){
        $title = $request->input('title');
        $category = $request->input('category');
        $penulis = $request->input('penulis');
        $jumlahDitambahkan = $request->input('jumlahDitambahkan');

        $tambah = $this->book->tambahBuku($title, $category, $penulis, $jumlahDitambahkan);
        if($tambah<1){
            return redirect()->route('home');
        }
        return redirect()->route('home');
    }

    public function viewUpdate(Request $request, $id){
        $book = DB::table('books')->where('id', $id)->get();
        return view('update', ['book' => $book[0], 'username' => $request->session()->get('user')]);
    }

    public function update(Request $request, $id){
        $jumlah = $request->input('jumlah');
        $update = $this->book->updateJumlahBuku($id, $jumlah);
        if($update<1){
            return redirect()->route('home');
        }
        return redirect()->route('home');
    }

    public function hapus($id){
        $del = DB::table('books')->where('id',$id)->delete();
        if($del<1){
            return redirect()->route('home');
        }
        return redirect()->route('home');
    }

}
