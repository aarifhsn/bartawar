<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class ValidationLogicTest extends TestCase
{
    use RefreshDatabase;
    public function test_post_creation_requires_content()
    {
        $user = User::factory()->create();
        $post = Post::create([
            'user_id' => $user->id,
            'content' => '',
        ]);
        $this->assertFalse($post->save());
    }

}
