<?php

namespace AbbasShDev\BlogPackage\Tests\Unit;

use Illuminate\Support\Facades\Bus;
use AbbasShDev\BlogPackage\Jobs\PublishPost;
use AbbasShDev\BlogPackage\Models\Post;
use AbbasShDev\BlogPackage\Tests\TestCase;

class PublishPostTest extends TestCase
{
    /** @test */
    public function it_publishes_a_post()
    {
        Bus::fake();

        $post = Post::factory()->create();

        $this->assertNull($post->published_at);

        PublishPost::dispatch($post);

        Bus::assertDispatched(PublishPost::class, function ($job) use ($post) {
            return $job->post->id === $post->id;
        });
    }
}