@extends('layouts.app')

@section('title')
    <title>List Articles</title>
@endsection

@section('header')
    <h1 class="mt-4">List Articles</h1>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('articles.index') }}">Articles</a>
        </li>
        <li class="breadcrumb-item active">List</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('articles.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control rounded-0" placeholder="Search by title or author's name" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary rounded-0" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publication Status</th>
                        <th>Publication Date</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publication Status</th>
                        <th>Publication Date</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->author->name }}</td>
                            <td>
                                <span class="badge {{ $article->isPublished() ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $article->publication_status->name }}
                                </span>
                            </td>
                            <td>{{ $article->publication_date }}</td>
                            <td>{{ $article->created_at }}</td>
                            <td>{{ $article->updated_at }}</td>
                            <td>
                                @can('publish', $article)
                                    @if (!$article->isPublished())
                                        <a class="btn btn-success btn-sm" href="#"
                                            onclick="event.preventDefault(); document.getElementById('publish-form-{{ $article->id }}').submit();">
                                            Publish
                                        </a>

                                        <form action="{{ route('articles.publish', $article) }}" method="POST"
                                            id="publish-form-{{ $article->id }}" style="display: none;">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $article->id }}" name="id">
                                        </form>
                                    @endif
                                @endcan

                                @can('view', $article)
                                    <a class="btn btn-primary btn-sm" href="{{ route('articles.show', $article) }}">Show</a>
                                @endcan

                                @can('update', $article)
                                    <a class="btn btn-warning btn-sm" href="{{ route('articles.edit', $article) }}">Edit</a>
                                @endcan

                                @can('delete', $article)
                                    <a class="btn btn-danger btn-sm" href="#"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $article->id }}').submit();">
                                        Delete
                                    </a>

                                    <form action="{{ route('articles.destroy', $article) }}" method="POST"
                                        id="delete-form-{{ $article->id }}" style="display: none;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" value="{{ $article->id }}" name="id">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $articles->withQueryString()->onEachSide(5)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
