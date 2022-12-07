<?php

namespace AbbasShDev\BlogPackage\Listeners;

use AbbasShDev\BlogPackage\Events\PostWasCreated;

class UpdatePostCreatedAt
{
    public function handle(PostWasCreated $event)
    {
        $event->post->update([
            'created_at' => now()
        ]);
    }
}