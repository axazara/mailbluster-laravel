<?php

namespace AxaZara\MailBluster\Exceptions;

use RuntimeException;

class InvalidApiUrl extends RunTimeException
{
    public function __construct()
    {
        parent::__construct('API url is invalid. Please set it in your .env file. Key name: MAILBLUSTER_API_URL ');
    }
}
