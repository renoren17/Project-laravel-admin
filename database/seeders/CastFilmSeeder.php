<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CastFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filmCastMap = [
            1 => [
                ['nama' => 'Hitori Gotou', 'umur' => 17, 'bio' => 'Gitaris berbakat dan pemalu.'],
                ['nama' => 'Ryou Yamada', 'umur' => 17, 'bio' => 'Teman dekat Hitori yang energik.'],
                ['nama' => 'Nijika Ijichi', 'umur' => 17, 'bio' => 'Drummer dan pemimpin band.'],
            ],
            2 => [
                ['nama' => 'Nokotan', 'umur' => 16, 'bio' => 'Rusa yang menjadi teman dekat protagonist.'],
                ['nama' => 'Anya', 'umur' => 15, 'bio' => 'Teman dekat karakter utama.'],
                ['nama' => 'Mimi', 'umur' => 16, 'bio' => 'Karakter yang penuh semangat dan kreatif.'],
            ],
        ];

        foreach ($filmCastMap as $filmId => $casts) {
            foreach ($casts as $castData) {
                $castId = DB::table('casts')->where('nama', $castData['nama'])->value('id');

                if (!$castId) {
                    $castId = DB::table('casts')->insertGetId([
                        'nama' => $castData['nama'],
                        'umur' => $castData['umur'],
                        'bio' => $castData['bio'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('perans')->updateOrInsert(
                    [
                        'film_id' => $filmId,
                        'cast_id' => $castId,
                    ],
                    [
                        'nama' => $castData['nama'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
