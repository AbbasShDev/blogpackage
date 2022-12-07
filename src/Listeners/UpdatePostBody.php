<?php

namespace AbbasShDev\BlogPackage\Listeners;

use AbbasShDev\BlogPackage\Events\PostWasCreated;

class UpdatePostBody
{
    public function handle(PostWasCreated $event)
    {
        $event->post->update([
            'body' => 'New: ' . $event->post->body
        ]);
    }
}