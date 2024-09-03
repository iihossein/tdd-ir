<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testInserData(): void
    {
        $data = Comment::factory()->make()->toArray();
        Comment::create($data);
        $this->assertDatabaseHas('comments', $data);
    }
    public function testCommentRelationshipWithPost()
    {
        $comment = Comment::factory()->hasCommentable(Post::factory())->create();
        $this->assertTrue(isset($comment->commentable->id));
        $this->assertTrue($comment->commentable instanceof Post);
    }
    public function testCommentRelationshipWithUser()
    {
        $comment = Comment::factory()->for(User::factory())->create();
        $this->assertTrue(isset($comment->user->id));
        $this->assertTrue($comment->user instanceof User);
    }
}
