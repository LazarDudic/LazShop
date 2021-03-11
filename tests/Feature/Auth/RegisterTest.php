<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register()
    {
        $this->post(route('register'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'example@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'country' => $this->faker->country,
            'state'   => $this->faker->state,
            'city'    => $this->faker->city,
            'address' => $this->faker->address,
            'zipcode' => $this->faker->postcode,
        ]);

        $this->assertEquals(1, User::all()->count());
    }
}
