<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsArticlesService;

class ArticlesController extends Controller
{
    public function __invoke(Request $request)
    {
        $articles = NewsArticlesService::make()->getArticles($request->string('query'));

        return response()->json($articles);
    }
}
