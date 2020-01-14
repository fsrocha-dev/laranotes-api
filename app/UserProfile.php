<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    protected $table = 'user_profile';

    protected $hidden = ['id', 'user_id', 'created_at'];

    protected $fillable = [
        'phone', 'mobile_phone', 'about', 'social_networks'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
