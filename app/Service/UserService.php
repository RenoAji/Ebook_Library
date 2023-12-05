<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class UserService
{
    function getUser(){
        $res = DB::table('users');
    }

    function register($name, $email, $password, $confirmPassword){
        if(DB::table('users')->where('email', $email)->exists()){
            return("Email sudah terdaftar");
        }

        if(DB::table('users')->where('name', $name)->exists()){
            return("Nama sudah terdaftar");
        }

        if($password !== $confirmPassword){
            return("Konfirmasi password tidak sesuai");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $register = DB::insert("INSERT INTO users (name, email, password, is_admin) VALUES (?, ?, ?, ?)", [$name, $email, $hashedPassword, false]) >= 1;

        return $register>0;
    }

    function login($name, $password){
        $res = DB::table('users')->where('name', $name);
        
        
        if($res->doesntExist()){
            return false;
        }
        return password_verify($password, $res->value('password'));
    }
}


