<?php

namespace AxaZara\MailBluster\Traits;

trait Fields
{
    private string $queue;

    private array $body = [];

    private string $method;

    private string $endpoint;

    public function createField(string $label, string $tag): ?object
    {
        $this->endpoint = '/fields';
        $this->method = 'POST';
        $this->body = [
            'fieldLabel'    => $label,
            'fieldMergeTag' => $tag,
        ];

        return ($this->makeRequest()) ? (object) $this->response->field : null;
    }

    public function getFields(): ?object
    {
        $this->endpoint = '/fields';
        $this->method = 'GET';

        return ($this->makeRequest()) ? (object) $this->response->fields : null;
    }

    public function updateField(string $id, string $label, string $tag): ?object
    {
        $this->endpoint = '/fields/' . $id;
        $this->method = 'PUT';
        $this->body = [
            'fieldLabel'    => $label,
            'fieldMergeTag' => $tag,
        ];

        return ($this->makeRequest()) ? (object) $this->response->field : null;
    }

    public function deleteField(string $id): bool
    {
        $this->endpoint = '/fields/' . $id;
        $this->method = 'DELETE';

        return $this->makeRequest();
    }
}
