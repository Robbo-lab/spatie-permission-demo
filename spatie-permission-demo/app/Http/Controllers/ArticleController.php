<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('publish articles')) {
            $articles = Article::with('user')->get();
            return view('articles.index', compact('articles'));

            abort(403, 'Unauthorised action.');
        }

        abort(403, 'Unauthorised action.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('publish articles')) {
            return view('articles.create');
        }
        
        abort(403, 'Unauthorised action.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        if (!Auth::user()->can('publish articles')) {
            abort(403, 'Unauthorised action.');
        }

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id); // Fetch the article or return a 404 if not found
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        if (Auth::user()->can('edit articles') || Auth::user()->hasRole('admin')) {
            return view('articles.edit', compact('article'));
        }

        // abort(403, 'Unauthorised action.');
        
        return redirect()->route('articles.index')->with('error', 'You dont have permission to authorise.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        if (!Auth::user()->can('edit articles')) {
            abort(403, 'Unauthorised action.');
        }

        $article->update($request->only(['title', 'content']));

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if (!Auth::user()->can('delete articles')) {
            // abort(403, 'Unauthorised action.');

            return redirect()->route('articles.index')->with('error', 'You dont have permission to authorise.');
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
