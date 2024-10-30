@extends('layout.app')

@section('content')
    <h2>Edit Article</h2>
    @include('articles._form', ['route' => route('articles.update', $article), 'method' => 'PUT', 'article' => $article])
@endsection