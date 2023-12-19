@extends('layouts.app')

@section('title', 'Home')

@section('header')
    <h1 class="mb-4">Dashboard</h1>
@endsection

@section('content')
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse ($articles as $article)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">{{ $article->title }}</h2>
                        <p class="card-text">
                            <small class="text-muted">Author: {{ $article->author->name }}</small>
                            <br>
                            <small class="text-muted">Publication Date: {{ $article->publication_date }}</small>
                        </p>
                        <p class="card-text">{{ Str::limit($article->content, 150) }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">
                            Read More <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <p class="text-center">No articles available.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $articles->onEachSide(5)->links('pagination::bootstrap-4') }}
    </div>
@endsection
