<?php

namespace AxaZara\MailBluster\Console;

use AxaZara\MailBluster\MailBlusterServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    protected $signature = 'mailbluster:install';

    protected $description = 'Install the MailBluster Laravel Package';

    public function handle(): void
    {
        $this->info('Installing MailBluster Laravel Package...');

        $this->info('Publishing configuration...');

        if (! $this->configExists()) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } elseif ($this->shouldOverwriteConfig()) {
            $this->info('Overwriting configuration file...');
            $this->publishConfiguration($force = true);
        } else {
            $this->info('Existing configuration was not overwritten');
        }

        $this->info('MailBluster Laravel Package installed successfully.');
    }

    private function configExists(): bool
    {
        return File::exists(config_path('mailbluster-laravel.php'));
    }

    private function shouldOverwriteConfig(): bool
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false): void
    {
        $params = [
            '--provider' => MailBlusterServiceProvider::class,
            '--tag' => 'config',
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }
        $this->call('vendor:publish', $params);
        $this->updateEnvironmentFile();
    }

    /**
     * Updates the environment file with the basic configuration.
     *
     * @return void
     */
    public function updateEnvironmentFile(): void
    {
        if (File::exists($env = app()->environmentFile())) {
            $contents = File::get($env);

            if (! Str::contains($contents, 'MAILBLUSTER_API_KEY=')) {
                File::append(
                    $env,
                    PHP_EOL.'MAILBLUSTER_API_KEY='.'test-api-key'.PHP_EOL,
                );
                $this->info('Added MAILBLUSTER_API_KEY to your .env file');
                $this->info('Please update the value with your MailBluster API key');
            } else {
                $this->info('MAILBLUSTER_API_KEY already exists in your .env file');
                $this->warn('Please adjust the `MAILBLUSTER_API_KEY` environment variable.');
            }
        }
    }
}
