<?php

namespace App\Data;

use App\Enums\NewsSourcesEnum;

class NewsArticleDto
{
    public function __construct(
        public readonly string $id,
        public readonly NewsSourcesEnum $source,
        public readonly string $title,
        public readonly string $url,
        public readonly string $datePublished,
    )
    {}
}
