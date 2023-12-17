<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'content', 'author_id', 'publication_date', 'publication_status'];

    protected $casts = [
        'publication_status' => PublicationStatus::class,
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
