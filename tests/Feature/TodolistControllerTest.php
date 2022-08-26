<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function test_todolistGet()
    {
        $this->withSession([
            'user' => 'pangestuk',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'pangestuk'
                ]
            ]
        ])->get('todolist')
        ->assertSeeText('1')
        ->assertSeeText('pangestuk');
    }

    public function test_todolistSaveFail()
    {
        $this->withSession([
            'user' => 'pangestuk'
        ])->post('todolist',[
            'todo' => ''
        ])->assertSeeText('Data input Todo kosong');
    }

    public function test_todolistSave()
    {
        $this->withSession([
            'user' => 'pangestuk'
        ])->post('todolist',[
            'todo' => 'ini rizkih'
        ])->assertRedirect('todolist');
    }

    public function test_todolistDelete()
    {
        $this->withSession([
            'user' => 'pangestuk',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'ini riskih',
                ]
            ]
        ])->post('todolist/1/delete')->assertRedirect('todolist');
    }
}
