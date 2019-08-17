<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class FollowUser extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        Auth::user()->following()->attach([$request->user_id]);
        $response = [
            'message' => trans('messages.followedsuccessfully')
        ];
        return response()->json($response, 200);
    }
}
