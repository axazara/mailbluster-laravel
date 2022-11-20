<?php

namespace AxaZara\MailBluster;

class MailBluster
{
    use Traits\Request;
    use Traits\Leads;
    use Traits\Fields;
    use Traits\Products;

    private object $payload;

    public function __construct()
    {
        $this->apiKey = config('mailbluster.api_key');
        $this->apiUrl = config('mailbluster.api_url');
    }
}
