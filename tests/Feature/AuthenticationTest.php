<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    public function test_unauthenticated_user_cannot_edit_profile()
    {
        $response = $this->get('/edit-profile');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    /**
     * Test that the homepage contains posts.
     */
    public function test_authenticated_user_can_edit_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/edit-profile');

        $response->assertStatus(200);
    }
}
