@extends('layouts.app')

@section('title')
    <title>Show Article - {{ $article->title }}</title>
@endsection

@section('header')
    <h1 class="mt-4">Show Article - {{ $article->title }}</h1>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('articles.index') }}">Articles</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
        </li>
        <li class="breadcrumb-item active">Show</li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ $article->title }}</h1>
        </div>
        <div class="card-body">
            <p class="lead">
                Author: {{ $article->author->name }}
            </p>
            <p class="lead">
                Status:
                <span class="badge {{ $article->isPublished() ? 'bg-success' : 'bg-secondary' }}">{{ $article->publication_status->name }}</span>
            </p>
            @if ($article->isPublished())
                <p class="lead">
                    Publication Date: {{ $article->publication_date }}
                </p>
            @endif

            <hr>
            <p>{{ $article->content }}</p>
        </div>
    </div>
@endsection
