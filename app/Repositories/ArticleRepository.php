<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    public function getAll()
    {
        $articles = Article::all();
        return $articles;
    }

    public function getById($id)
    {
        $article = Article::findOrFail($id);
        return $article;
    }

    public function create(array $data)
    {
        $article = Article::create($data);
        return $article;
    }

    public function update(int $id, array $data)
    {
        $article = Article::findOrFail($id);
        $article->update($data);
        return $article;
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return $article;
    }
}
