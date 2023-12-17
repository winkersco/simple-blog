<?php

namespace App\Services;

use App\Repositories\ArticleRepository;

class ArticleService
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAll()
    {
        return $this->articleRepository->getAll();
    }

    public function getById($id)
    {
        return $this->articleRepository->getById($id);
    }

    public function create(array $data)
    {
        $user = auth()->user();
        $data['author_id'] = $user->id;
        return $this->articleRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $user = auth()->user();
        $data['author_id'] = $user->id;
        return $this->articleRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->articleRepository->delete($id);
    }
}
