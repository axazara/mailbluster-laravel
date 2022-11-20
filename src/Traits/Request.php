<?php

namespace AxaZara\MailBluster\Traits;

use AxaZara\MailBluster\Config;
use AxaZara\MailBluster\Exceptions\RequestError;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait Request
{
    private string $queue;

    private array $body = [];

    private string $method;

    private string $endpoint;

    public mixed $response;

    private function makeRequest(): bool
    {
        $this->validate();

        $payload = [
            'method' => $this->method,
            'body' => $this->body,
            'url' => $this->apiUrl.$this->endpoint,
        ];

        return $this->dispatch($payload);
    }

    private function validate(): void
    {
        Config::validateApiUrl($this->apiUrl);
        Config::validateApiKey($this->apiKey);
    }

    private function dispatch(array $payload): bool
    {
        $this->payload = (object) $payload;

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => config('mailbluster.api_key'),
            ])->withBody(json_encode($this->payload->body, JSON_THROW_ON_ERROR), 'application/json')
                ->{$this->payload->method}($this->payload->url);

            $this->response = (object) $response->json();

            if ($response->failed()) {
                $this->lastError = $response;
                Log::error('MailBluster Error :: '.$this->lastError.' URL :: '.$this->payload->url.' Request Body :: '.json_encode($this->payload->body, JSON_THROW_ON_ERROR));

                return false;
            }

            return true;
        } catch (Exception $e) {
            Log::error('MailBluster :: Exception :'.$e->getMessage());

            if (config('app.debug')) {
                throw new RequestError($e->getMessage());
            }

            $this->lastError = $e->getMessage();

            return false;
        }
    }
}
