<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'umur',
        'bio',
        'alamat',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'profile_id');
    }
}
