<?php

namespace App\Http\Controllers;

use App\Http\Handlers\ArticlesHandler;
use App\Http\Requests\ArticlesStoreRequest;
use App\Models\Article;
use App\Traits\UnsplashTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    use UnsplashTrait;

    /**
     * Create Article
     * @param Request $request
     * @return \Illuminate\Foundation\Application|View|Factory|Application
     */
    public function create(Request $request): \Illuminate\Foundation\Application|View|Factory|Application
    {

        $image = $this->getUnsplashImage();

        return view('pages.articles.show', [
            'image' => $image
        ]);

    }

    /**
     * Store Article
     * @param ArticlesStoreRequest $request
     * @param ArticlesHandler $handler
     * @return RedirectResponse
     */
    public function store(ArticlesStoreRequest $request, ArticlesHandler $handler): \Illuminate\Http\RedirectResponse
    {

        if ($article = $handler->process($request))
        {
            return redirect()->route('home')->with('success', 'Article Added!');
        }else{
            return back()->with('error', 'Error');
        }

    }

    /**
     * Show Article Edit
     * @param Article $article
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Request $request, Article $article): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('pages.articles.show', [
            'article' => $article
        ]);
    }

    /**
     * Update Article
     * @param ArticlesStoreRequest $request
     * @param ArticlesHandler $handler
     * @param Article $article
     * @return RedirectResponse
     */
    public function update(ArticlesStoreRequest $request, ArticlesHandler $handler, Article $article): RedirectResponse
    {
        if ($article = $handler->process($request, $article))
        {
            return redirect()->route('home')->with('success', 'Article Updated!');
        }else{
            return back()->with('error', 'Error');
        }
    }

    /**
     * Destroy Article
     * @param Request $request
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Request $request, Article $article): RedirectResponse
    {

        if ( $article->delete() ) return back()->with('success', 'Destroy is Success!');

        return back()->with('error', 'Error');

    }

}
