@extends('layouts.app')

@section('title')
    <title>List Trashed Articles</title>
@endsection

@section('header')
    <h1 class="mt-4">List Trashed Articles</h1>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('articles.trash') }}">Trashed Articles</a>
        </li>
        <li class="breadcrumb-item active">List</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('articles.trash') }}" method="GET" class="mb-3">
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
                        <th>Deleted At</th>
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
                        <th>Deleted At</th>
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
                            <td>{{ $article->deleted_at }}</td>
                            <td>
                                @can('restore', $article)
                                    <a class="btn btn-success btn-sm" href="#"
                                        onclick="event.preventDefault(); document.getElementById('restore-form-{{ $article->id }}').submit();">
                                        Restore
                                    </a>

                                    <form action="{{ route('articles.restore', $article) }}" method="POST"
                                        id="restore-form-{{ $article->id }}" style="display: none;">
                                        {{ csrf_field() }}
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
