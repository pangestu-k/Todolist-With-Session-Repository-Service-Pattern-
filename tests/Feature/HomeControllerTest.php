<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_homeGuest()
    {
        $this->get('/')->assertRedirect('/login');
    }

    public function test_homeMember()
    {
        $this->withSession([
            'user' => 'pangestuk'
        ])->get('/')->assertRedirect('/todolist');
    }
}
