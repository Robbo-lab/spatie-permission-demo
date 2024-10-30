@extends('layout.app')

@section('content')
    <div class="container mt-5 text-center">
        <h1>Welcome to the Article Management Application</h1>

        <div class="mt-4">
            @auth
                <p>Welcome back, {{ auth()->user()->name }}!</p>
                <a href="{{ route('articles.index') }}" class="btn btn-primary">View Articles</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Logout</button>
                </form>
            @else
                <p>Please log in to access the application.</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
        </div>
    </div>
@endsection