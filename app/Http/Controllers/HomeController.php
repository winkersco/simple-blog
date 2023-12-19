<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;

class HomeController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Show all published articles.
     */
    public function __invoke()
    {
        $articles = $this->articleService->getPublished();
        return view('pages.home', ['articles' => $articles]);
    }
}

