<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForum extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_authenticated_user_my_participate_in_forum_threads()
    {
        // Givin we have an authenticated user
        $this->be($user = factory(User::class)->create());

        // And an existing thread
        $thread = factory(Thread::class)->create();

        // When the user add a reply to the thread
        $reply = factory(Reply::class)->make();
        $this->post('/threads/'. $thread->id .'/replies', $reply->toArray());

        //then their reply should be included on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
