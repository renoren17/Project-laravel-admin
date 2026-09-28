<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'judul',
        'ringkasan',
        'tahun',
        'poster',
        'trailer_url',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre');
    }

    public function cast()
    {
        return $this->belongsToMany(Cast::class, 'perans')
            ->withPivot('nama')
            ->withTimestamps();
    }
}