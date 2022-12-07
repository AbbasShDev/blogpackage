<?php

namespace AbbasShDev\BlogPackage\Listeners;

use AbbasShDev\BlogPackage\Events\PostWasCreated;

class UpdatePostTitle
{
    public function handle(PostWasCreated $event)
    {
        $event->post->update([
            'title' => 'New: ' . $event->post->title
        ]);
    }
}