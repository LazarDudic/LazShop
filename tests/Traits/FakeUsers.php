<?php

namespace Tests\Traits;

use App\Models\User;

trait FakeUsers
{
    public function admin()
    {
        $email = $this->faker->email;

        User::factory()->create([
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $email,
            'role_id' => 1,
            'password' => 'password',
        ]);

        return $this->actingAs(User::where('email', $email)->first());
    }

    public function user()
    {
        return User::factory()->create();
    }

    public function buyer()
    {
        $email = $this->faker->email;

        User::factory()->create([
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $email,
            'role_id' => 3,
            'password' => 'password',
        ]);

        return $this->actingAs(User::where('email', $email)->first());
    }
}
