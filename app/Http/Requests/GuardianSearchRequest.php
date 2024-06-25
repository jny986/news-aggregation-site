<?php

namespace App\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use App\Data\NewsArticleDto;
use App\Enums\NewsSourcesEnum;

class GuardianSearchRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/search';
    }

    protected function defaultQuery(): array
    {
        return [
            'format' => 'json',
        ];
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $articles = $response->collect('response.results');

        $articles->map(function ($article) {
            return new NewsArticleDto(
                id: $article['id'],
                source: NewsSourcesEnum::Guardian,
                title: $article['webTitle'],
                url: $article['webUrl'],
                datePublished: $article['webPublicationDate'],
            );
        });

        return $articles;
    }
}
