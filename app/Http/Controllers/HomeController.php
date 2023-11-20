<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * @param Request $request
     * @param Article $article
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request, Article $article): \Illuminate\Foundation\Application|View|Factory|Application
    {

        return view('home', [
            'articles' => Auth::check() ? $article->paginate(10) : null
        ]);

    }
}
