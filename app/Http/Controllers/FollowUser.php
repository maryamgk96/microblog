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
        Auth::user()->following()->attach([$request->user_id]);
        $response = [
            'success' => true,
            'message' => 'you followed user successfully.'
        ];
        return response()->json($response, 200);
    }
}
