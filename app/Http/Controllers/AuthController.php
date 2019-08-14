<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUserRequest;

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
        // $validated = $request->validated();
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'data' => 'Validation Error.',
        //         'message' => $validator->errors()
        //     ];
        //     return response()->json($response, 404);
        // }
        $avatarName ='avatar_'.time();
        $request->image->storeAs('avatars',$avatarName);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $avatarName
        ]);
 
        $token = $user->createToken('Token')->accessToken;
 
        return response()->json(['token' => $token], 200);
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
            $token = auth()->user()->createToken('Token')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
}
