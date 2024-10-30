@extends('layout.app')

@section('title', 'Articles')

@section('content')
    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Create New Article</a>

    
    @if($articles->isEmpty())
        <p>No articles available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <!-- Article title -->
                        <td>{{ $article->title }}</td>
                        <!-- Article creator -->
                        <td>{{ $article->user->name }}</td>
                        <!-- Article view/edit/delete-->
                        <td>
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection