<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    protected $fillable = ['title', 'content', 'author_id', 'publication_date', 'publication_status'];

    protected $casts = [
        'publication_status' => PublicationStatus::class,
    ];

    public function isPublished()
    {
        return $this->publication_status == PublicationStatus::PUBLISH;
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('publication_status', PublicationStatus::PUBLISH->value);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getSearchFields()
    {
        return [
            'title',
            'author.name'
        ];
    }
}
