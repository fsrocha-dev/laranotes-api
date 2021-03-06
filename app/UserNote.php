<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNote extends Model
{
    protected $table = 'user_notes';

    protected $fillable = [
        'user_id', 'title', 'body', 'slug'
    ];

    public function user()
    {
        // A note pertence ao usuário, porém o usuário pode ter várias notas.
        return $this->belongsTo(User::class);
    }
}
