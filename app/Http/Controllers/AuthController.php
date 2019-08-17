<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUserRequest;
use App;
class AuthController extends Controller
{
    
    /**
     * Handles Registration Request
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StoreUserRequest $request)
    {

        $avatarName ='avatar_'.time().'.'.request()->image->getClientOriginalExtension();
        $request->image->storeAs('avatars',$avatarName);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $avatarName
        ]);
 
        return $user->respondWithToken();
    }
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            return auth()->user()->respondWithToken();
        } else {
            return response()->json(['error' => trans('messages.unauthorised')], 401);
        }
    }
}
