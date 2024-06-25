# News Aggregation Site

## Setup

1. Ensure that you have Docker installed - Manage docker containers with Laravel Sail
2. Run `cp .env.example .env`
3. Run `composer install`
4. Run `vendor/bin/sail up -d`
5. Run `vendor/bin/sail artisan key:generate`
6. Add your Guardian API KEY to the `.env` file: `GUARDIAN_API_KEY='OUR_API_KEY_HERE'`
7. Run `vendor/bin/sail artisan migrate`

## Usage

The fetching of news articles can be achieved by going to the `/articles` endpoint and optionally takes a query parameter of `query` that will search for this string

## Built With

I created this application with [Laravel](https://laravel.com/) and used the following packages

-   [Jetstream](https://jetstream.laravel.com/) (A first party package to scaffold applications with Auth, [Tailwind CSS](https://tailwindcss.com/) & [Livewire](https://laravel-livewire.com/))
-   [Saloon](https://docs.saloon.dev/) (API Integration scaffold)
-   [PestPHP](https://pestphp.com/) (PHPUnit wrapper with Laravel Extension)

## Progress

I was able to create the backend to fetch the articles but run out of time to create a front end to take allow input of a search query and to display the news articles

I would also like to have created some more tests and have the oportunity to add Form Requests & Resource response for the ArticleController.
