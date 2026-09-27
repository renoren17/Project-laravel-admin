<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'bio',
        'role',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'profile_id');
    }
}
