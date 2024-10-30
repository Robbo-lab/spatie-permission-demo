@extends('layout.app')

@section('content')
    <h2>Create New Article</h2>
    @include('articles._form', ['route' => route('articles.store'), 'method' => 'POST'])
@endsection
