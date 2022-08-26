<?php

namespace App\Services\Impl;

use App\Services\UserService;

Class UserServiceImpl implements UserService {

    private array $user = [
        'pangestuk' => 'rahasia'
    ];

    public function login ($user, $password)
    {
        if(! isset($this->user[$user])){
            return false;
        }

        $correct_password = $this->user[$user];
        return $password == $correct_password;
    }
}
