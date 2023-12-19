@extends('layouts.app')

@section('title')
    <title>Edit Article</title>
@endsection

@section('header')
    <h1 class="mt-4">Edit Article</h1>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('articles.index') }}">Articles</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
        </li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('articles.update', $article) }}">
                @csrf
                {{ method_field('PUT') }}

                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ $article->content }}</textarea>
                </div>


                @can('publish', \App\Models\Article::class)
                    <div class="mb-3">
                        <label for="publication_status" class="form-label">Publication Status</label>
                        <select class="form-control" id="publication_status" name="publication_status">
                            @foreach (\App\Enums\PublicationStatus::options() as $statusLabel => $statusValue)
                                <option value="{{ $statusValue }}" @if ($article->publication_status->value == $statusValue) selected @endif>{{ $statusLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="publication_date" class="form-label">Publication Date</label>
                        <input type="date" class="form-control" id="publication_date" name="publication_date" value="{{ $article->publication_date }}">
                    </div>
                @endcan

                <button type="submit" class="btn btn-primary mt-3">Update Article</button>
            </form>
        </div>
    </div>
@endsection
