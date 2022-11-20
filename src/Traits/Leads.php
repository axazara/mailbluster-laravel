<?php

namespace AxaZara\MailBluster\Traits;

trait Leads
{
    private string $queue;

    private array $body = [];

    private string $method;

    private string $endpoint;

    public array $lead;

    /**
     * Create new lead
     * $Fiels is array contain new leads infos
     *
     * @param  string  $email
     * @param  bool  $subscribed
     * @param  array  $options
     * @return object|null
     *
     * @see https://app.mailbluster.com/api-doc/leads
     */
    public function createLead(string $email, bool $subscribed = true, array $options = []): ?object
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \AxaZara\MailBluster\Exceptions\InvalidEmail();
        }

        $this->body = array_merge($options, [
            'email' => $email,
            'subscribed' => $subscribed,
        ]);
        $this->method = 'POST';
        $this->endpoint = '/leads';

        return ($this->makeRequest()) ? (object) $this->response->lead : null;
    }

    /**
     * View specific lead
     *
     * @param  string  $email
     * @return object|null
     *
     * @see https://app.mailbluster.com/api-doc/leads/read
     */
    public function readLead(string $email): ?object
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \AxaZara\MailBluster\Exceptions\InvalidEmail();
        }

        $this->method = 'GET';
        $this->endpoint = '/leads/'.md5($email);

        return ($this->makeRequest()) ? (object) $this->response : null;
    }

    /**
     * Update lead
     *
     * @param  string  $email
     * @param  array  $fields
     * @return object|null
     *
     * @see https://app.mailbluster.com/api-doc/leads/update
     */
    public function updateLead(string $email, array $fields = []): ?object
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \AxaZara\MailBluster\Exceptions\InvalidEmail();
        }
        $this->body = $fields;
        $this->method = 'PUT';
        $this->endpoint = '/leads/'.md5($email);

        return ($this->makeRequest()) ? (object) $this->response->lead : null;
    }

    /**
     * Delete lead
     *
     * @param  string  $leadEmail
     * @return bool
     *
     * @see https://app.mailbluster.com/api-doc/leads/delete
     */
    public function deleteLead(string $leadEmail): bool
    {
        $this->method = 'DELETE';
        $this->endpoint = '/leads/'.md5($leadEmail);

        return $this->makeRequest();
    }
}
