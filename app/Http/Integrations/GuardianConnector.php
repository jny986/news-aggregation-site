<?php

namespace App\Http\Integrations;

use Saloon\Http\Auth\QueryAuthenticator;
use Saloon\Http\Connector;

class GuardianConnector extends Connector
{
    public function __construct(public readonly string $token) {}

    public function resolveBaseUrl(): string
    {
        return config('services.guardian.base_url');
    }

    protected function defaultAuth(): QueryAuthenticator
    {
        return new QueryAuthenticator('api-key', $this->token);
    }
}
