<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    /** @test */
    public function profile_can_be_updated()
    {
        $user = $this->user();

        $this->actingAs($user)->patch(route('profile.update', $user->id), [
            'first_name' => 'First Name',
            'last_name'  => 'Last Name',
            'email'      => 'example@email.com',
        ]);

        $user = User::find($user->id);

        $this->assertEquals('First Name', $user->first_name);
    }

    /** @test */
    public function password_can_be_updated()
    {
        $user = $this->user();

        $this->actingAs($user)->patch(route('profile.update-password', $user->id), [
            'old_password' => 'password',
            'new_password' => 'newpassword',
            'new_password_confirmation' => 'newpassword'
        ]);

        $user = User::find($user->id);
        $this->assertTrue(Hash::check('newpassword', $user->password));
    }


}
