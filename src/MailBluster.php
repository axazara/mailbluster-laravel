<?php

namespace AxaZara\MailBluster;

class MailBluster
{
    use Traits\Request;

    use Traits\Leads;

    use Traits\Fields;

    use Traits\Products;

    private object $payload;

    private ?string $apiKey;

    private ?string $apiUrl;

    private ?string $lastError = null;

    public function __construct()
    {
        $this->apiKey = config('mailbluster.api_key');
        $this->apiUrl = config('mailbluster.api_url');
    }

    public function getLastError(): ?string
    {
        return $this->lastError;
    }
}
