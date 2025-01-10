<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_contains_empty_table(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSeeText('No posts found');
    }

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

    public function test_post_update_validation_error_redirects_back_to_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/', [
            'content' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('content');
    }


}
