<?php

namespace AxaZara\MailBluster\Tests;

use AxaZara\MailBluster\MailBlusterServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        @file_put_contents('/tmp/boot-trace.log', "1:getPackageProviders\n", FILE_APPEND);

        return [
            MailBlusterServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        @file_put_contents('/tmp/boot-trace.log', "2:getEnvironmentSetUp\n", FILE_APPEND);
        config()->set('database.default', 'testing');
        config()->set('app.debug', 'true');
        @file_put_contents('/tmp/boot-trace.log', "3:getEnvironmentSetUp-done\n", FILE_APPEND);
    }
}
