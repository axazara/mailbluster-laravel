<?php

namespace AxaZara\MailBluster\Traits;

trait Products
{
    private ?string $apiKey;

    private ?string $apiUrl;

    private string $queue;

    private array $body = [];

    private string $method;

    private string $endpoint;

    public function createProduct(string $id, string $name): ?object
    {
        $this->endpoint = '/products';
        $this->method = 'POST';
        $this->body = [
            'id' => $id,
            'name' => $name,
        ];

        return ($this->makeRequest()) ? $this->response->product : null;
    }

    public function getProducts(): ?object
    {
        $this->endpoint = '/products';
        $this->method = 'GET';

        return ($this->makeRequest()) ? $this->response->products : null;
    }

    public function getProduct(string $id): ?object
    {
        $this->endpoint = '/products/'.$id;
        $this->method = 'GET';

        return ($this->makeRequest()) ? $this->response->product : null;
    }

    public function updateProduct(string $id, string $name): ?object
    {
        $this->endpoint = '/products/'.$id;
        $this->method = 'PUT';
        $this->body = [
            'name' => $name,
        ];

        return ($this->makeRequest()) ? $this->response->product : null;
    }

    public function deleteProduct(string $id): bool
    {
        $this->endpoint = '/products/'.$id;
        $this->method = 'DELETE';

        return (bool) $this->makeRequest();
    }
}
