<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostManagementTest extends TestCase
{
    public function test_post_belongs_to_user()
    {
        $user = User::factory()->create();
        $post = Post::create([
            'user_id' => $user->id,
            'content' => 'My first post',
        ]);

        $this->assertEquals($user->id, $post->user->id);
    }
}
