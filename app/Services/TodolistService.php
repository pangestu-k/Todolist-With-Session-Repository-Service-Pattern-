<?php

namespace App\Services;

Interface TodolistService{
    public function saveTodo($id, $todo);

    public function getTodolist();

    public function removeTodo($todoId);
}
