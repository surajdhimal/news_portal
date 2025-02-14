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
         // Find the article by its ID
         $article = Article::find($id);

         // If the article doesn't exist, return with an error (optional)
         if (!$article) {
             return redirect()->back()->with('error', 'Article not found!');
         }

         // Validate the request
         $request->validate([
             'title' => 'required|string',
             'description' => 'required|string',
             'meta_keywords' => 'nullable|string',
             'meta_description' => 'nullable|string',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make sure this matches the input name
             'categories' => 'required|array',
             'status' => 'required|string|in:pending,approved,rejected' // Adding validation for status
         ]);

         // Update article fields
         $article->title = $request->title;
         $article->description = $request->description;
         $article->meta_keywords = $request->meta_keywords;
         $article->meta_description = $request->meta_description;
         $article->status = $request->status; // Update status as well

         // Handle image upload (if a new image is uploaded)
         $file = $request->file('image'); // Correct input name 'image' from the form
         if ($file) {
             // Generate a new name for the image and save it
             $newName = time() . "." . $file->getClientOriginalExtension();
             $file->move(public_path('images'), $newName);

             // If an old image exists, remove it (optional)
             if ($article->image && file_exists(public_path($article->image))) {
                 unlink(public_path($article->image));
             }

             // Save the new image path in the article
             $article->image = "images/$newName";
         }

         // Save the article (whether the image was uploaded or not)
         $article->save();

         // Update categories
         $article->categories()->sync($request->categories);

         return redirect()->route('admin.article.index');
     }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}






