<?php

namespace App\Policies;

use App\Enums\PublicationStatus;
use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->can('article-view')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Article $article): bool
    {
        if ($article->isPublished()) {
            return true;
        }
        if ($user->can('article-view')) {
            return true;
        }
        return $article->author->id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): bool
    {
        if ($user->can('article-update')) {
            return true;
        }
        return $article->author->id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): bool
    {
        if ($user->can('article-delete')) {
            return true;
        }
        if (!$article->isPublished()) {
            return $article->author->id == $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article): bool
    {
        if ($user->can('article-restore')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article): bool
    {
        //
    }

    /**
     * Determine whether the user can publish the model.
     */
    public function publish(User $user): bool
    {
        if ($user->can('article-publish')) {
            return true;
        }
        return false;
    }

        /**
     * Determine whether the user can view trashed models.
     */
    public function trash(User $user): bool
    {
        if ($user->can('article-trash')) {
            return true;
        }
        return false;
    }
}
