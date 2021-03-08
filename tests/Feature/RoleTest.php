<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /** @test */
    public function roll_can_be_created()
    {
        $name = $this->faker->name;
        $this->admin()->post(route('roles.store'), [
            'name' => $name,
            'permissions' => [
                'view-product',
                'create-product',
                'edit-product',
                'delete-product'
            ]
        ]);

        $this->assertEquals(1, Role::where('name', $name)->get()->count());
    }

    /** @test */
    public function roll_can_be_updated()
    {
        $role = Role::find(3);

        $this->admin()->patch(route('roles.update', $role->id), [
            'name' => 'NewName',
            'permissions' => [
                'view-product',
                'create-product',
                'edit-product',
                'delete-product'
            ]
        ]);

        $this->assertEquals(1, Role::where('name', 'NewName')->get()->count());
    }

    /** @test */
    public function role_can_be_deleted()
    {
        $response = $this->admin()->delete(route('roles.update', 3));

        $response->assertSessionHas('success', 'Role deleted successfully.');
    }
}
