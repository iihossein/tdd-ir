<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function testInsertData(): void
    {
        $data = User::factory()->make()->toArray();
        $data['password'] = bcrypt(123456);
        User::create($data);
        $this->assertDatabaseHas('users', $data);
    }
    public function testUserRelationshipWithPost()
    {
        $count = rand(1, 10);
        $user = User::factory()->hasPosts($count)->create();
        $this->assertCount($count, $user->posts);
        $this->assertTrue($user->posts->first() instanceof Post);
    }
    public function testUserRelationshipWithComment()
    {
        $count = rand(1, 10);
        $user = User::factory()->hasComments($count)->create();
        $this->assertCount($count, $user->comments);
        $this->assertTrue($user->comments->first() instanceof Comment);
    }
}
