<?php

namespace Database\Seeders;

use App\Models\Cast;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeed extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['nama' => 'Comedy'],
            ['nama' => 'Music'],
            ['nama' => 'Slice of Life'],
        ];

        foreach ($genres as $genreData) {
            Genre::firstOrCreate(['nama' => $genreData['nama']]);
        }

        $filmData = [
            [
                'judul' => 'Bocchi the Rock!',
                'ringkasan' => 'Cerita tentang Hitori Gotou, seorang gadis pemalu yang ingin tampil hebat di band.',
                'tahun' => 2022,
                'genres' => ['Music', 'Comedy', 'Slice of Life'],
                'poster' => 'images/posters/Bocchi the Rock!.jpeg',
            ],
            [
                'judul' => 'My Deer Friend Nokotan',
                'ringkasan' => 'Anime komedi yang penuh kehangatan dengan karakter unik dan kisah yang ringan.',
                'tahun' => 2023,
                'genres' => ['Comedy', 'Slice of Life'],
                'poster' => 'images/posters/Shikanoko Nokonoko Koshitantan.jpeg',
            ],
        ];

        foreach ($filmData as $film) {
            $newFilm = Film::firstOrCreate(
                ['judul' => $film['judul']],
                [
                    'ringkasan' => $film['ringkasan'],
                    'tahun' => $film['tahun'],
                    'poster' => $film['poster'],
                ]
            );

            $genreIds = Genre::whereIn('nama', $film['genres'])->pluck('id');
            $newFilm->genres()->sync($genreIds);
        }

        $castData = [
            ['nama' => 'Hitori Gotou', 'umur' => 17, 'bio' => 'Gitaris pemalu dan berbakat.'],
            ['nama' => 'Ryou Yamada', 'umur' => 17, 'bio' => 'Teman dekat Hitori yang energetik.'],
            ['nama' => 'Nijika Ijichi', 'umur' => 17, 'bio' => 'Drummer dan pemimpin band.'],
            ['nama' => 'Nokotan', 'umur' => 16, 'bio' => 'Karakter lucu yang menjadi pusat cerita.'],
            ['nama' => 'Anya', 'umur' => 15, 'bio' => 'Teman dekat karakter utama.'],
            ['nama' => 'Mimi', 'umur' => 16, 'bio' => 'Karakter yang penuh semangat dan kreatif.'],
        ];

        foreach ($castData as $data) {
            $cast = Cast::firstOrCreate(
                ['nama' => $data['nama']],
                ['umur' => $data['umur'], 'bio' => $data['bio']]
            );
        }

        $movieCastMap = [
            'Bocchi the Rock!' => ['Hitori Gotou', 'Ryou Yamada', 'Nijika Ijichi'],
            'My Deer Friend Nokotan' => ['Nokotan', 'Anya', 'Mimi'],
        ];

        foreach ($movieCastMap as $judul => $castNames) {
            $film = Film::where('judul', $judul)->first();
            if (!$film) continue;

            foreach ($castNames as $castName) {
                $castId = Cast::where('nama', $castName)->value('id');
                if (!$castId) continue;

                DB::table('perans')->updateOrInsert(
                    [
                        'film_id' => $film->id,
                        'cast_id' => $castId,
                    ],
                    [
                        'nama' => $castName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}