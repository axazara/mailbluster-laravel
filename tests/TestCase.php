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
        config()->set('mailify.api_url', 'https://api.getmailify.io');
        config()->set('mailify.api_key', 'test-key');
        config()->set('mailify.reply_to');
        config()->set('mailify.priority', 0);
        config()->set('mailify.queue', 'default');
    }
}
