<?php

namespace AxaZara\MailBluster\Tests;

use AxaZara\MailBluster\MailBlusterServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            MailBlusterServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('app.debug', 'true');
    }
}
