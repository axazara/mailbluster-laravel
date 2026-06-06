<?php

namespace AxaZara\MailBluster\Tests;

use AxaZara\MailBluster\Facades\MailBluster;
use Illuminate\Support\Facades\Bus;

class MailBlusterLaravelTest extends TestCase
{
    public function setUp(): void
    {
        @file_put_contents('/tmp/boot-trace.log', "0:setUp-before-parent\n", FILE_APPEND);
        parent::setUp();
        @file_put_contents('/tmp/boot-trace.log', "4:setUp-after-parent\n", FILE_APPEND);
        Bus::fake();
        @file_put_contents('/tmp/boot-trace.log', "5:setUp-after-busfake\n", FILE_APPEND);
    }

    /** @test */
    public function it_should_throw_an_exception_if_api_url_is_not_set(): void
    {
        $this->expectException(\AxaZara\MailBluster\Exceptions\InvalidApiUrl::class);

        config()->set('mailbluster.api_url');
        config()->set('mailbluster.api_key');
        MailBluster::createLead('test@test.com');
    }

    /** @test */
    public function it_should_throw_an_exception_if_api_token_key_is_not_set(): void
    {
        $this->expectException(\AxaZara\MailBluster\Exceptions\ApiKeyIsMissing::class);

        config()->set('mailbluster.api_url', 'https://api.mailbluster.com');
        config()->set('mailbluster.api_key');
        MailBluster::createLead('test@test.com');
    }
}
