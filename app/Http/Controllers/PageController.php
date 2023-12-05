<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function home(Request $request){
        $books = DB::table('books')->get();
        $user = $request->session()->get('user');
        if(is_null($user)){
            return redirect('/login');
        }
        $is_admin = $request->session()->get('is_admin', false);
        $status = 'user';
        if($is_admin){
            $status = 'admin';
        }

        return response()
        ->view('home.home', ['books' => $books ,
                            'is_admin' => $is_admin, 
                            'status' => $status, 
                            'username' => $user]);
    }

    public function viewPeminjaman(Request $request){
        $is_admin = $request->session()->get('is_admin', false);
        if($is_admin){
            return redirect()->action([PageController::class, 'viewPeminjamanAdmin']);
        }else{
            return redirect()->action([PageController::class, 'viewPeminjamanUser']);
        }
    }

    public function viewPeminjamanUser(Request $request){
        $user_name = $request->session()->get('user');

        $peminjaman_confirmed = DB::table('peminjaman')
                        ->where('user_name', $user_name)
                        ->where('is_confirmed', true)
                        ->join('books', 'peminjaman.book_id', '=', 'books.id')
                        ->select('peminjaman.*', 'books.*')->get();

        $peminjaman_not_confirmed = DB::table('peminjaman')
                                ->where('user_name', $user_name)
                                ->where('is_confirmed', false)
                                ->join('books', 'peminjaman.book_id', '=', 'books.id')
                                ->select('peminjaman.*', 'books.*')->get();

        return view('peminjaman.user', ['peminjaman_confirmed' => $peminjaman_confirmed, 
                                        'peminjaman_not_confirmed'=> $peminjaman_not_confirmed, 
                                        'username' => $user_name,]);
    }

    public function viewPeminjamanAdmin(Request $request){
        $user = $request->session()->get('user');
        $peminjaman = DB::table('peminjaman')
                        ->join('books', 'peminjaman.book_id', '=', 'books.id')
                        ->select('peminjaman.*', 'books.title')
                        ->where('is_confirmed', false)->get();

        return view('peminjaman.admin', ['peminjaman' =>$peminjaman,
                                        'username' => $user,]);
    }
}
