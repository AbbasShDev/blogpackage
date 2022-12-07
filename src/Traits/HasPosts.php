<?php

namespace AbbasShDev\BlogPackage\Traits;

use AbbasShDev\BlogPackage\Models\Post;

trait HasPosts
{
    public function posts()
    {
        return $this->morphMany(Post::class, 'author');
    }
}