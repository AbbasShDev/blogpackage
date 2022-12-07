<?php

namespace AbbasShDev\BlogPackage\Tests;

use AbbasShDev\BlogPackage\BlogPackageServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            BlogPackageServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_posts_table.php';
        include_once __DIR__ . '/../database/migrations/create_users_table.php';

        // run the up() method (perform the migration)
        (new \CreatePostsTable)->up();
        (new \CreateUsersTable)->up();
    }
}