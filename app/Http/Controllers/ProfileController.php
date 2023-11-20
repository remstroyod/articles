<?php

namespace App\Http\Controllers;

use App\Http\Handlers\ProfileHandler;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request): \Illuminate\Foundation\Application|View|Factory|Application
    {

        return view('pages.profile.index', [
            'user' => Auth::user()
        ]);

    }

    /**
     * @param ProfileUpdateRequest $request
     * @param ProfileHandler $handler
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request, ProfileHandler $handler): RedirectResponse
    {

        if ($user = $handler->process($request))
        {
            return back()->with('success', 'Profile Updated!');
        }else{
            return back()->with('error', 'Error Update');
        }

    }

}
