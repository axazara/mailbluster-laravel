<?php

namespace AxaZara\MailBluster\Tests;

use AxaZara\MailBluster\Facades\MailBluster;
use Illuminate\Support\Facades\Bus;
use PHPUnit\Framework\Attributes\Test;

class MailBlusterLaravelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Bus::fake();
    }

    #[Test]
    public function it_should_throw_an_exception_if_api_url_is_not_set(): void
    {
        $this->expectException(\AxaZara\MailBluster\Exceptions\InvalidApiUrl::class);

        config()->set('mailbluster.api_url');
        config()->set('mailbluster.api_key');
        MailBluster::createLead('test@test.com');
    }

    #[Test]
    public function it_should_throw_an_exception_if_api_token_key_is_not_set(): void
    {
        $this->expectException(\AxaZara\MailBluster\Exceptions\ApiKeyIsMissing::class);

        config()->set('mailbluster.api_url', 'https://api.mailbluster.com');
        config()->set('mailbluster.api_key');
        MailBluster::createLead('test@test.com');
    }
}
