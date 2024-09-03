<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testInserData(): void
    {
        $data = Post::factory()->make()->toArray();
        Post::create($data);
        $this->assertDatabaseHas('posts', $data);
    }
    function testPostRelationshipWithUser()
    {
        $post = Post::factory()->for(User::factory())->create();
        $this->assertTrue(isset($post->user->id));
        $this->assertTrue($post->user instanceof User);
    }
    public function testPostRelationshipWithTag()
    {
        $count = rand(1, 10);
        $post = Post::factory()->hasTags($count)->create();
        $this->assertCount($count, $post->tags);
        $this->assertTrue($post->tags->first() instanceof Tag);
    }
    public function testPostRelationshipWithComment()
    {
        $count = rand(1, 10);
        $post = Post::factory()->hasComments($count)->create();
        $this->assertCount($count, $post->comments);
        $this->assertTrue($post->comments->first() instanceof Comment);
    }
}
