<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodolistService;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function getAllData()
    {
        return response()->view('todolist.todolist', [
            'title' => 'Todolist',
            'todolist' => $this->todolistService->getTodolist()
        ]);
    }

    public function saveData()
    {
        $todo = request()->input('todo');

        if(empty($todo)){
            $todolist = $this->todolistService->getTodolist();
            return response()->view('todolist.todolist',[
                'title' => 'Todolist',
                'error' => 'Data input Todo kosong',
                'todolist' => $todolist
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);

        return redirect()->action([\App\Http\Controllers\TodolistController::class, 'getAllData']);
    }

    public function removeData($id)
    {
        $this->todolistService->removeTodo($id);
        return redirect()->action([\App\Http\Controllers\TodolistController::class, 'getAllData']);
    }
}
