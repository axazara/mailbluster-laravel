<?php

namespace AxaZara\MailBluster;

class Config
{
    public static function getQueue(): string
    {
        if (config('mailify.queue') === 'default') {
            return 'default';
        }

        return  config('mailify.queue');
    }

   public static function validateApiUrl($api_url): void
   {
       if (! filter_var($api_url, FILTER_VALIDATE_URL)) {
           throw new \AxaZara\MailBluster\Exceptions\InvalidApiUrl();
       }
   }

    public static function validateApiKey($api_key): void
    {
        if (empty($api_key)) {
            throw new \AxaZara\MailBluster\Exceptions\ApiKeyIsMissing();
        }
    }
}
