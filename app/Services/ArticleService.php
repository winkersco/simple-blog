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

    public function getAllPublished($perPage = 10)
    {
        return Article::published()->orderBy('publication_date', 'desc')->paginate($perPage);
    }

    public function index()
    {
        return auth()->user()->can('viewAny', Article::class)
            ? $this->articleRepository->getAll()
            : $this->articleRepository->getByAuthor(auth()->user()->id);
    }
    public function store(array $data)
    {
        $this->checkPublishAccess($data);
        $user = auth()->user();
        $data['author_id'] = $user->id;
        $this->articleRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $this->checkPublishAccess($data);
        $user = auth()->user();
        $data['author_id'] = $user->id;
        $this->articleRepository->update($id, $data);
    }

    public function destroy($id)
    {
        $this->articleRepository->delete($id);
    }

    public function publish($id)
    {
        $data = [
            'publication_status' => PublicationStatus::PUBLISH->value,
            'publication_date' => now()
        ];
        $this->articleRepository->update($id, $data);
    }

    protected function checkPublishAccess(array &$data)
    {
        if (!auth()->user()->can('publish', Article::class)) {
            unset($data['publication_date'], $data['publication_status']);
        }
    }
}
