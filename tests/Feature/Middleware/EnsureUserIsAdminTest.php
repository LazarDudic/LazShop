<?php

namespace Tests\Feature\Middleware;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnsureUserIsAdminTest extends TestCase
{
    /** @test */
    public function abort_if_not_admin_user()
    {
        $response = $this->buyer()->get(route('roles.index'));

        $response->assertStatus(403);
    }

    /** @test */
    public function access_if_admin_user()
    {
        $response = $this->admin()->get(route('roles.index'));

        $response->assertStatus(200);
    }

}
