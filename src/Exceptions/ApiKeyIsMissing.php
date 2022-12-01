<?php

namespace AxaZara\MailBluster\Exceptions;

use RuntimeException;

class ApiKeyIsMissing extends RunTimeException
{
    public function __construct()
    {
        parent::__construct('API key is missing. Please set it in your .env file. Key name: MAILBLUSTER_API_KEY ');
    }
}
