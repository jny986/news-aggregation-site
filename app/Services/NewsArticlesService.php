<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Http\Integrations\GuardianConnector;
use App\Http\Requests\GuardianSearchRequest;

class NewsArticlesService
{
    public static function make(): self
    {
        return new self();
    }

    public function getArticles(?string $query = null): Collection
    {
        $articles = $this->getGuardianArticles($query);

        return $articles;
    }

    protected function getGuardianArticles(?string $query = null): Collection
    {
        $connector = new GuardianConnector(config('services.guardian.api_key'));
        $request = GuardianSearchRequest::make();

        if (filled($query)) {
            $request->query()->add('q', $query);
        }

        $response = $connector->send($request);

        $articles = $response->dtoOrFail();

        return $articles;
    }
}
