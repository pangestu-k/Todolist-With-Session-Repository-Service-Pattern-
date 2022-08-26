<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_loginPage()
    {
        $this->get('/login')
            ->assertStatus(200)
            ->assertSeeText('Login');
    }

    public function test_loginSuccess()
    {
        $this->post('login', [
            'user' => 'pangestuk',
            'password' => 'rahasia'
        ])->assertSessionHas('user', 'pangestuk');
    }

    public function test_validationLogin()
    {
        $this->post('login', [
            'user' => '',
            'password' => '',
        ])->assertSeeText('Login')
            ->assertViewIs('user.login')
            ->assertSee('Username atau Password harus diisi');
    }

    public function test_failLogin()
    {
        $this->post('login', [
            'user' => 'salah',
            'password' => 'salah',
        ])->assertSeeText('Login')
            ->assertViewIs('user.login')
            ->assertSee('Username atau Password salah');
    }

    public function test_logout()
    {
        $this->withSession([
            'user' => 'pangestuk'
        ])->post('logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }

    public function test_loginMember()
    {
        $this->withSession([
            'user' => 'pangestuk'
        ])->get('login')
        ->assertRedirect('/');
    }

    public function test_loginUser()
    {
        $this->withSession([
            'user' => 'pangestuk'
        ])->post('login',[
            'user' => 'pangestuk',
            'password' => 'rahasia'
        ])->assertRedirect('/');
    }

    public function test_logoutGuest()
    {
        $this->post('login',[
            'user' => 'pangestuk',
            'password' => 'rahasia'
        ])->assertRedirect('/');
    }
}
