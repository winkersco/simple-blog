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

    public function getTrashed()
    {
        return Article::onlyTrashed()->get();
    }

    public function getByAuthor($authorId)
    {
        return Article::where('author_id', $authorId)->get();
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
        return Article::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Article::where('id', $id)->delete();
    }

    public function restore($id)
    {
        return Article::withTrashed()->where('id', $id)->restore();
    }
}
