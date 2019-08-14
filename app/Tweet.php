<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tweet extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body','user_id'
    ];

    
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
