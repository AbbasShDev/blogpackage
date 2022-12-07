<?php

namespace AbbasShDev\BlogPackage\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use AbbasShDev\BlogPackage\Events\PostWasCreated;
use AbbasShDev\BlogPackage\Listeners\UpdatePostTitle;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostWasCreated::class => [
            UpdatePostTitle::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}