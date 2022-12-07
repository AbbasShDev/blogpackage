<?php

namespace AbbasShDev\BlogPackage\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallBlogPackage extends Command
{
    protected $signature = 'blogpackage:install';

    protected $description = 'Install the BlogPackage';

    public function handle()
    {
        $this->info('Installing BlogPackage...');

        $this->info('Publishing configuration...');

        if(!$this->configExists('blogpackage.php')){
            $this->publishConfiguration();
            $this->info('Published configuration');
        }else{
            if($this->shouldOverwriteConfig()){
                $this->publishConfiguration(true);
            }else{
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed BlogPackage');

        return Command::SUCCESS;
    }

    private function configExists(string $fileName): bool
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig(): bool
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration(bool $forcePublish = false): void
    {
        $params = [
            '--provider' => "AbbasShDev\BlogPackage\BlogPackageServiceProvider",
            '--tag' => "config"
        ];

        if($forcePublish){
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);

    }
}