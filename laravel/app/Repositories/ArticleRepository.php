<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    public function getAll($search='', $perPage = 10)
    {
        return Article::search($search)->paginate($perPage);
    }

    public function getPublished($perPage = 10)
    {
        return Article::published()->orderBy('publication_date', 'desc')->latest()->paginate($perPage);
    }

    public function getTrashed($search='', $perPage = 10)
    {
        return Article::onlyTrashed()->search($search)->paginate($perPage);
    }

    public function getByAuthor($authorId, $search='', $perPage = 10)
    {
        return Article::where('author_id', $authorId)->search($search)->paginate($perPage);
    }
    public function getById($id)
    {
        return Article::findOrFail($id);
    }

    public function create(array $data)
    {
        return Article::create($data);
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
