@extends('layouts.app')

@section('title')
    <title>Create Article</title>
@endsection

@section('header')
    <h1 class="mt-4">Create Article</h1>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('articles.index') }}">Articles</a>
        </li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('articles.store') }}">
                @csrf
        
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
        
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                </div>
        
                <button type="submit" class="btn btn-primary mt-3">Create Article</button>
            </form>
        </div>
    </div>
@endsection
