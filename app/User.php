<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Http\Resources\TweetResource;
use App\Tweet;
use App\User;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets()
    {
      return $this->hasMany(Tweet::class);
    }

    public function following()
    {
     return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'user_id')->withTimestamps();
    }
    /**
     * Handles user's timeline
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function timeline()
    {
        $following = $this->following()->with(['tweets' => function ($query) {
            $query->orderBy('created_at', 'desc')->paginate(10);
        }])->get();
        $timeline = $following->flatMap(function ($values) {
            return $values->tweets;
        });
        $sorted = $timeline->sortByDesc(function ($tweet) {
            return $tweet->created_at;
        });
      
        return TweetResource::collection(collect($sorted->values()->all()));
    }
    /**
     * Creats json response with generated access token
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithToken()
    {
      return response()->json([
        'token_type' => 'Bearer',
        'access_token' => $this->createToken('Token')->accessToken,
      ],200);
    }
}
