<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Service\UserService;

class UserTest extends TestCase
{
    public function testLogin(): void
    {
        $user = $this->app->make(UserService::class);
        $this->get('/login')
            ->assertSeeText('Login');

        $this->post('/login',['name' => 'admin','password'=>'adminpassword'])
            ->assertRedirect('/');

        $this->post('/login',['name' => 'admin','password'=>'password salah'])
            ->assertSeeText('Login');
    }

    public function testRegister(): void
    {
        $user = $this->app->make(UserService::class);
        $this->get('/register')
            ->assertSeeText('Register');
        //self::assertEquals($user->register('reno', 'budi@gmail.com','pass1234', 'pass1234'), 'Email sudah terdaftar');
        // $this->post('/register',['name' => 'admin', 'email' => 'renoaji25sep@gmail.com','password'=>'passadmin','confirm_password' => 'passadmin'])
        //     ->assertStatus(302);

        $this->post('/register',['name' => 'reno', 'email' => 'renoaji@gmail.com','password'=>'passreno','confirm_password' => 'passreno'])
        ->assertStatus(302);
    }
}
