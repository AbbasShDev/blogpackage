<?php

namespace AbbasShDev\BlogPackage\Tests\Unit;

use AbbasShDev\BlogPackage\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use AbbasShDev\BlogPackage\Tests\TestCase;
use AbbasShDev\BlogPackage\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_has_a_title()
    {
        $post = Post::factory()->create(['title' => 'Fake Title']);
        $this->assertEquals('Fake Title', $post->title);
    }

    /** @test */
    function a_post_has_a_body()
    {
        $post = Post::factory()->create(['body' => 'Fake Body']);
        $this->assertEquals('Fake Body', $post->body);
    }

    /** @test */
    function a_post_has_an_author_type()
    {
        $post = Post::factory()->create(['author_type' => 'Fake\User']);
        $this->assertEquals('Fake\User', $post->author_type);
    }

    /** @test */
    function a_post_belongs_to_an_author()
    {
        // Given we have an author
        $author = User::factory()->create();
        // And this author has a Post
        $author->posts()->create([
            'title' => 'My first fake post',
            'body'  => 'The body of this fake post',
        ]);

        $this->assertCount(1, Post::all());
        $this->assertCount(1, $author->posts);

        // Using tap() to alias $author->posts()->first() to $post
        // To provide cleaner and grouped assertions
        tap($author->posts()->first(), function ($post) use ($author) {
            $this->assertEquals('My first fake post', $post->title);
            $this->assertEquals('The body of this fake post', $post->body);
            $this->assertTrue($post->author->is($author));
        });
    }
}