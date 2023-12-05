<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class UserServiceController extends Controller
{
    private $user;
    public function __construct(UserService $userService){
        $this->user = $userService;
    }
    public function register($register = null){
        return response()->view('register', ['register' => $register]);
    }

    public function doRegister(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        $register = $this->user->register($name,$email,$password,$confirm_password);
        return redirect()->action([UserServiceController::class, 'register'], ['register' => $register]);
    }

    public function login(Request $request){
        $cookie = $request->cookie('cookie');
        $id = $request->cookie('id');
        $key = $request->cookie('key');

        $user = DB::table('users')->where('id', $id);
        if($cookie == true and $key == hash('whirlpool', $user->value('name'))){
            return redirect('/');
            $request->session()->put('user', $user->value('name'));
            $request->session()->put('is_admin', $user->value('is_admin'));
        }

        return response()->view('login');
    }

    public function doLogin(Request $request){
        $name = $request->input('name');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        $userTable = DB::table('users')->where('name', $name);
        $is_admin = $userTable->value('is_admin');

        if(!$this->user->login($name, $password)){
            return response()->view('login', ['sukses' => false]);
        }

        $time=0;
        if($remember){
            $time = 1000;
        }

        $request->session()->put('user', $name);
        $request->session()->put('is_admin', $is_admin);
        return redirect('/')
                ->cookie('cookie', $remember, $time)
                ->cookie('id', $userTable->value('id'), $time)
                ->cookie('key', hash('whirlpool',$userTable->value('name')), $time);
    }

    public function logout(Request $request){
        $request->session()->flush();
        $array = array();
        foreach (Cookie::get() as $key => $item){
            $array []= cookie($key, null, -2628000, null, null);
        }
        return back()->withCookies($array);

    }
}
