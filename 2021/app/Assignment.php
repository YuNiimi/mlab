<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'user_id',
        'assignment'
    ];

    //belongsTo設定
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
