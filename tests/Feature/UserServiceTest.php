<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
   private UserService $userService;

   protected function setup() : void
   {
        parent::setup();

        $this->userService = $this->app->make(UserService::class);
   }

   public function testSample ()
   {
        self::assertTrue(true);
   }

   public function test_loginSuccess()
   {
        self::assertTrue($this->userService->login('pangestuk','rahasia'));
   }

   public function test_userNotFound()
   {
        self::assertFalse($this->userService->login('rizky','rahasia'));
   }

   public function test_userPasswordWrong()
   {
        self::assertFalse($this->userService->login('pangestuk','salah'));
   }


}
