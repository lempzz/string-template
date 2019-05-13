<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController
{
    public function get(Article $article)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'title'      => $article->getTitle(),
                'created_at' => $article->getCreatedAt(),
                'seo_title'  => $article->getSeoTitle(),
            ]
        ]);
    }

    public function edit(Article $article)
    {
        //disable string template for present original text
        Article::useTemplate(false);

        return response()->json([
            'status' => 'success',
            'data' => [
                'title'      => $article->getTitle(),
                'created_at' => $article->getCreatedAt(),
                'seo_title'  => $article->getSeoTitle(),
            ]
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $article->setSeoTitle($request->get('seo_title'));

        $article->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Article was successfully update',
            'data'    => [
                'seo_title' => $article->getSeoTitle()
            ]
        ]);
    }
}