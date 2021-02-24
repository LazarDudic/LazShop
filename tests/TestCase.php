<?php

namespace Tests;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker, RefreshDatabase;

    public function authUser()
    {
        $this->post(route('register'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'auth@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        return $this->actingAs(User::where('email', 'auth@email.com')->first());
    }

    public function user()
    {
        return User::factory()->create();
    }

    public function category()
    {
        return Category::factory()->create();
    }
}
