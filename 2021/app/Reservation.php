<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'AM',
        'PM',
        'Bulk',
    ];

    public $timestamps = true;

    //belongsTo設定
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
