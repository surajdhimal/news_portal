<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;

class PageController extends BaseController
{

    public function home(){
        $articles = Article::where('status', 'approved')->get();
        $latest_article = Article::orderBy('id', 'desc')->where('status', 'approved')->first();
        $trending_articles = Article::orderBy('views', 'desc')->where('status','approved')->limit(8)->get();
        return view('frontend.home', compact('articles', 'latest_article','trending_articles'));
    }
}
