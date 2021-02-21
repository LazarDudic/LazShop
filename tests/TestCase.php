<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function authUser()
    {
        $this->post(route('register'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'auth@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        return User::where('email', 'auth@email.com')->first();
    }

    public function user()
    {
        return User::factory()->create();
    }
}
