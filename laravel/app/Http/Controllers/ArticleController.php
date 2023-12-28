<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);
        $articles = $this->articleService->index($search, $perPage);
        return view('pages.articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        return view('pages.articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $this->articleService->store($request->validated());
        return redirect()->route('articles.index')->with('message', [
            'type' =>'success',
            'text' => 'Article created successfully.'
        ]);
    }

    public function show(Article $article)
    {
        $this->authorize('view', $article);
        return view('pages.articles.show', ['article' => $article]);
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('pages.articles.edit', ['article' => $article]);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        $this->articleService->update($article->id, $request->validated());
        return redirect()->route('articles.show', $article->id)->with('message', [
            'type' =>'success',
            'text' => 'Article updated successfully.'
        ]);
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $this->articleService->destroy($article->id);
        return redirect()->route('articles.index')->with('message', [
            'type' =>'success',
            'text' => 'Article deleted successfully.'
        ]);
    }

    public function publish(Article $article)
    {
        $this->authorize('publish', $article);
        $this->articleService->publish($article->id);
        return redirect()->route('articles.index')->with('message', [
            'type' =>'success',
            'text' => 'Article published successfully.'
        ]);
    }

    public function trash(Request $request)
    {
        $this->authorize('trash', Article::class);
        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);
        $articles = $this->articleService->trash($search, $perPage);
        return view('pages.articles.trash', ['articles' => $articles]);
    }

    public function restore(Article $article)
    {
        $this->authorize('restore', $article);
        $this->articleService->restore($article->id);
        return redirect()->route('articles.index')->with('message', [
            'type' =>'success',
            'text' => 'Article restored successfully.'
        ]);
    }
}
