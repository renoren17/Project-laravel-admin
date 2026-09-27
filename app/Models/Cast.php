<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $fillable = ['nama', 'umur', 'bio'];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'perans');
    }
}
