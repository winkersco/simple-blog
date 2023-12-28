<?php

namespace App\Services;

use App\Enums\PublicationStatus;
use App\Models\Article;
use App\Repositories\ArticleRepository;

class ArticleService
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getPublished($perPage = 10)
    {
        return $this->articleRepository->getPublished($perPage);
    }

    public function index($search='', $perPage = 10)
    {
        return auth()->user()->can('viewAny', Article::class)
            ? $this->articleRepository->getAll($search, $perPage)
            : $this->articleRepository->getByAuthor(auth()->user()->id, $search, $perPage);
    }

    public function store(array $data)
    {
        $this->checkPublishAccess($data);
        $user = auth()->user();
        $data['author_id'] = $user->id;
        return $this->articleRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $this->checkPublishAccess($data);
        $user = auth()->user();
        $data['author_id'] = $user->id;
        return $this->articleRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->articleRepository->delete($id);
    }

    public function publish($id)
    {
        $data = [
            'publication_status' => PublicationStatus::PUBLISH->value,
            'publication_date' => now()
        ];
        return $this->articleRepository->update($id, $data);
    }

    public function trash($search='', $perPage = 10)
    {
        return $this->articleRepository->getTrashed($search, $perPage);
    }

    public function restore($id)
    {
        return $this->articleRepository->restore($id);
    }

    protected function checkPublishAccess(array &$data)
    {
        if (!auth()->user()->can('publish', Article::class)) {
            unset($data['publication_date'], $data['publication_status']);
        }
    }
}
