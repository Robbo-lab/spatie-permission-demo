<form action="{{ $route }}" method="POST">
    @csrf
    @if($method == 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $article->title ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content', $article->content ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">{{ $method == 'PUT' ? 'Update' : 'Create' }} Article</button>
    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
</form>
