<?php

namespace AbbasShDev\BlogPackage\Tests\Unit;

use AbbasShDev\BlogPackage\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class InstallBlogPackageTest extends TestCase
{
    /** @test */
    function the_install_command_copies_the_configuration()
    {
        $configFilePath = config_path('blogpackage.php');

        if (File::exists($configFilePath)) {
            unlink($configFilePath);
        }

        $this->assertFalse(File::exists($configFilePath));

        Artisan::call('blogpackage:install');

        $this->assertTrue(File::exists($configFilePath));
    }

    public function when_a_config_file_is_present_users_can_choose_to_not_overwrite_it()
    {
        File::put(config_path('blogpackage.php'), 'test content');

        $this->assertTrue(File::exists(config_path('blogpackage.php')));

        $command = $this->artisan('blogpackage:install');

        $command->expectsConfirmation(
            'Config file already exists. Do you want to overwrite it?'
        );

        $command->expectsOutput('Existing configuration was not overwritten');

        $this->assertEquals('test content', file_get_contents(config_path('blogpackage.php')));

        unlink(config_path('blogpackage.php'));

    }

    public function when_a_config_file_is_present_users_can_choose_to_do_overwrite_it()
    {
        File::put(config_path('blogpackage.php'), 'test content');

        $this->assertTrue(File::exists(config_path('blogpackage.php')));

        $command = $this->artisan('blogpackage:install');

        $command->expectsConfirmation(
            'Config file already exists. Do you want to overwrite it?',
            'yes'
        );

        $command->execute();

        $command->expectsOutput('Overwriting configuration file...');

        $this->assertEquals(
            __DIR__.'/../config/blogpackage.php',
            file_get_contents(config_path('blogpackage.php'))
        );

        unlink(config_path('blogpackage.php'));

        unlink(config_path('blogpackage.php'));
    }
}