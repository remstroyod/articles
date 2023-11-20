<?php
namespace App\Http\Handlers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileHandler extends BaseHandler
{

    use UploadFileTrait;

    public function process(
        ProfileUpdateRequest $request
    ):?User {

        try {

            $user = Auth::user();

            $user->fill($request->only(['name', 'email']));
            $user->avatar = $this->uploadFile($request, 'avatars', $user->avatar);

            if( $request->has('password') && !is_null($request->input('password')) ) $user->password = Hash::make($request->input('password'));

            $user->save();

            return $user;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            dd($e->getMessage());
            return null;

        }

    }

}
