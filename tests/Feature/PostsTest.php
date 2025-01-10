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

    public function test_admin_can_see_delete_button()
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        Post::create([
            'user_id' => User::factory()->create()->id,
            'content' => 'My post',
        ]);

        $response = $this->actingAs($admin)->get('/');

        $response->assertStatus(200);

        // Dump the content if needed for debugging
        $response->assertSeeText('Delete');
    }

    public function test_non_admin_cannot_see_delete_button()
    {
        $user = User::factory()->create();



        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertDontSeeText('Delete');
    }

    public function test_post_deleted_successfully()
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $post = Post::create([
            'user_id' => User::factory()->create()->id,
            'content' => 'My post to check deletion',
        ]);

        $response = $this->actingAs($admin)->delete('/question/' . $post->id);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Post deleted successfully!');
    }

}
