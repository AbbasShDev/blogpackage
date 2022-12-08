<?php

namespace AbbasShDev\BlogPackage\Listeners;

use AbbasShDev\BlogPackage\Events\PostWasCreated;

class UpdatePostUpdatedAt
{
    public function handle(PostWasCreated $event)
    {
        $event->post->update([
            'updated_at' => null
        ]);
    }
}