<?php

namespace App\Http\Controllers;

use App\Http\Handlers\ProfileHandler;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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

    /**
     * User Destroy
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {

        if ( $user->delete() ) return redirect()->route('home')->with('success', 'User Deleted!');

        return back()->with('error', 'Error');

    }

}
