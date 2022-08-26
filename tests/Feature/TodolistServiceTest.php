<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
   private TodolistService $todolistService;

   public function setup() : void
   {
        parent::setup();
        $this->todolistService = $this->app->make(TodolistService::class);
   }

   public function test_todolistService()
   {
        self::assertNotNull($this->todolistService);
   }

   public function test_saveTodolist()
   {
        $this->todolistService->saveTodo('1','Pangestuk');

        $todolist = session()->get('todolist');
        foreach ($todolist as $value) {
            self::assertEquals('1',$value['id']);
            self::assertEquals('Pangestuk',$value['todo']);
        }
   }

   public function test_getTodolist()
   {
        $expected = [
            [
                'id' => '1',
                'todo' => 'pangestuk'
            ],
            [
                'id' => '2',
                'todo' => 'riskih'
            ],
        ];
        $this->todolistService->saveTodo('1','pangestuk');
        $this->todolistService->saveTodo('2','riskih');
        $this->assertEquals($expected,$this->todolistService->getTodolist());
   }

   public function test_getTodolistEmpty()
   {
        $expected = [];
        $this->assertEquals($expected,$this->todolistService->getTodolist());
   }

   public function test_removeTodolist()
   {
        $this->todolistService->saveTodo('1','pangestuk');
        $this->todolistService->saveTodo('2','rizkih');

        $this->todolistService->removeTodo('3');
        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo('1');
        self::assertEquals(1, sizeof($this->todolistService->getTodolist()));
   }
}
