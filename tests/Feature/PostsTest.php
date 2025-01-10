<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up the environment for each test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Ensure migrations are run before each test
        $this->artisan('migrate:fresh');
    }

    /**
     * Test that the homepage contains an empty table when no posts exist.
     */
    public function test_homepage_contains_empty_table(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSeeText('No posts found');
    }

    /**
     * Test that the homepage contains posts.
     */
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

    /**
     * Test that the homepage contains posts.
     */
    public function test_homepage_contains_posts()
    {
        $user = User::factory()->create();

        Post::create([
            'user_id' => $user->id,
            'content' => 'My first post',
        ]);

        Post::create([
            'user_id' => $user->id,
            'content' => 'My second post',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSeeText('My first post');
        $response->assertSeeText('My second post');
    }

    /**
     * Test that paginated posts doesnt show more than 10 posts.
     */
    public function test_paginated_posts_doesnt_show_more_than_10_posts()
    {
        for ($i = 1; $i <= 15; $i++) {
            Post::create([
                'user_id' => User::factory()->create()->id,
                'content' => 'My post ' . $i,
            ]);
        }

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSeeText('My post 10');
        $response->assertDontSeeText('My post 11');
    }

    public function test_admin_can_see_delete_button()
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('Delete');
    }

    public function test_non_admin_cannot_see_delete_button()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertDontSeeText('Delete');
    }
}
