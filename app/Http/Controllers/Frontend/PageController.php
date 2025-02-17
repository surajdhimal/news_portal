<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PageController extends BaseController
{
    public function home()
    {
        // Get articles that are approved
        $articles = Article::where('status', 'approved')->get();
        $latest_article = Article::orderBy('id', 'desc')->where('status', 'approved')->first();
        $trending_articles = Article::orderBy('views', 'desc')->where('status', 'approved')->limit(8)->get();

        return view('frontend.home', compact('articles', 'latest_article', 'trending_articles'));
    }

    public function category($slug)
    {
        // Fetch the category using the slug and get articles associated with that category
        $category = Category::where('slug', $slug)->first();

        // Check if category exists
        if (!$category) {
            return redirect()->route('home')->with('error', 'Category not found');
        }

        $articles = $category->articles()->paginate(2);
        return view('frontend.category', compact('articles', 'category'));
    }

    public function article($id)
    {
        // Fetch the article by ID
        $article = Article::findOrFail($id);

        // Check if the user has already visited this article
        $cookie_data = Cookie::get("article$id");
        if (!$cookie_data) {
            $article->increment('views');  // Increment views if not visited before
            Cookie::queue("article$id", $article->id);  // Set the cookie to track that the article was viewed
        }

        return view('frontend.article', compact('article'));
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $articles = Article::where('title', 'like', "%$q%")->orWhere('description','like',"%$q%")->where('status','approved')->paginate(4);
        if (count($articles) == 0) {
            return view('404page');
        }

        return view('frontend.search', compact('articles'));
    }
}
