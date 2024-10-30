@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h1>{{ $article->title }}</h1>
    <p class="text-muted">Written by {{ $article->user->name }} on {{ $article->created_at->format('F j, Y') }}</p>
    
    <div class="article-content">
        <p>{{ $article->content }}</p>
    </div>

    <a href="{{ route('articles.index') }}" class="btn btn-secondary mt-3">Back to Articles</a>
</div>
@endsection