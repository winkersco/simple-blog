@extends('layouts.app')

@section('pre-styles')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            // Simple-DataTables
            // https://github.com/fiduswriter/Simple-DataTables/wiki

            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
@endsection

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
            <table id="datatablesSimple">
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
        </div>
    </div>
@endsection
