<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy("id", "desc")->get();
        return view("admin.article.index", compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.article.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return request();
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->meta_keywords = $request->meta_keywords;
        $article->meta_description = $request->meta_description;
        $file = $request->image;
        if ($file) {
            $newName = time() . "." . $file->getClientOriginalExtension();
            $file->move("images", $newName);
            $article->image = "images/$newName";
        }
        $article->save();
        $article->categories()->attach($request->categories);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::select("eng_title", "id")->get();
        $article = Article::find($id);
        return view("admin.article.edit", compact("categories", "article"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'categories' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article = Article::find($id);
        $file = $request->image;
        if ($file) {
            $newName = time() . "." . $file->getClientOriginalExtension();
            $file->move('images', $newName);
            unlink($article->image);
        }

        if ($file) {
            $article->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'image' => "images/" . $newName
            ]);
        } else {
            $article->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
            ]);
        }

        return redirect()->route("admin.article.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
// 49:00
