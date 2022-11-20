<?php

namespace AxaZara\MailBluster\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AxaZara\MailBluster\MailBluster createLead(array $fields)
 * @method static \AxaZara\MailBluster\MailBluster later()
 * @method static \AxaZara\MailBluster\MailBluster afterResponse()
 */
class MailBluster extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mailbluster';
    }
}
