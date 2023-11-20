<?php
namespace App\Http\Handlers;

use App\Http\Requests\ArticlesStoreRequest;
use App\Models\Article;
use App\Models\UnsplashAssets;

class ArticlesHandler extends BaseHandler
{

    public function process(
        ArticlesStoreRequest $request,
        Article $article = null): ?Article
    {
        try {

            if (!$article) $article = new Article();

            $article->fill($request->all());
            $article->save();

            return $article;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }
    }

}
