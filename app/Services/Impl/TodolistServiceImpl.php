<?php

namespace App\Services\Impl;

use App\Services\TodolistService;

class TodolistServiceImpl implements TodolistService
{
    public function saveTodo($id, $todo)
    {
        if (!session()->has('todolist')) {
            session()->put('todolist', []);
        }

        session()->push('todolist', [
            'id' => $id,
            'todo' => $todo,
        ]);
    }

    public function getTodolist()
    {
        return session()->get('todolist') ?? [];
    }

    public function removeTodo($todoId)
    {
        $todolist = session()->get('todolist');
        foreach ($todolist as $key => $value) {
            if ($value['id'] == $todoId) {
                unset($todolist[$key]);
                break;
            }
        }
        session()->put('todolist', $todolist);
    }
}
