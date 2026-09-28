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
            ['nama' => 'Romance'],
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
            [
                'judul' => 'Seihantai na Kimi to Boku',
                'ringkasan' => 'Miyu Suzuki adalah siswi SMA ceria yang duduk di sebelah Yuusuke Tani, siswa yang tak peduli pada pandangan orang lain. Meski memiliki kepribadian yang bertolak belakang, keduanya perlahan saling tertarik hingga hubungan mereka berkembang menjadi sesuatu yang lebih dari sekadar teman.',
                'tahun' => 2026,
                'genres' => ['Comedy', 'Romance'],
                'poster' => 'images/posters/1790523125_seihantainokimitoboku.jpg',
            ],
            [
                'judul' => 'Danshi Koukousei no Nichijou',
                'ringkasan' => 'Hidenori, Yoshitake, dan Tadakuni adalah tiga sahabat di sebuah SMA khusus laki-laki. Hari-hari mereka dipenuhi berbagai kejadian konyol, imajinasi absurd, dan petualangan sederhana yang selalu berakhir menghibur.',
                'tahun' => 2012,
                'genres' => ['Comedy', 'Slice of Life'],
                'poster' => 'images/posters/1790523432_danshikoukouseinonichijou.jpg',
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
            ['nama' => 'Miyu Suzuki', 'umur' => 16, 'bio' => 'Miyu Suzuki adalah gadis ceria yang menjalani hidup apa adanya.'],
            ['nama' => 'Yuusuke Tani', 'umur' => 16, 'bio' => 'Yuusuke Tani adalah cowok yang selalu mengatakan apa yang ada di pikirannya, tanpa terlalu memedulikan pendapat orang lain.'],
            ['nama' => 'Shuuji Taira', 'umur' => 16, 'bio' => 'Cowok pemalu yang sering merasa cemas, kurang percaya diri, dan sulit menerima dirinya sendiri.'],
            ['nama' => 'Shino Azuma', 'umur' => 16, 'bio' => 'Gadis yang mudah mengikuti keadaan dan sering berusaha menyesuaikan diri demi orang lain. Ia mudah memaafkan dan cenderung menganggap sepele hal-hal buruk yang terjadi padanya.'],
            ['nama' => 'Kentarou Yamada', 'umur' => 16, 'bio' => 'Teman sekelas sekaligus teman dekat Suzuki.'],
            ['nama' => 'Natsumi Nishi', 'umur' => 16, 'bio' => 'Gadis pemalu yang canggung dalam bersosialisasi dan sulit membuka diri pada orang lain.'],
            ['nama' => 'Rikako Honda', 'umur' => 16, 'bio' => 'Rikako adalah sahabat Natsumi yang paling memahami sifat pemalu dan canggungnya.'],
            ['nama' => 'Manami Watanabe', 'umur' => 16, 'bio' => 'Manami adalah salah satu sahabat dekat sekaligus teman sekelas Suzuki.'],
            ['nama' => 'Aoi Satou', 'umur' => 16, 'bio' => 'Aoi adalah salah satu sahabat dekat sekaligus teman sekelas Suzuki.'],
            ['nama' => 'Hidenori Tabata', 'umur' => 16, 'bio' => 'Hidenori adalah pemimpin trio yang penuh ide gila dan tingkah konyol.'],
            ['nama' => 'Yoshitake Tanaka', 'umur' => 17, 'bio' => 'Yoshitake adalah anggota trio yang impulsif, konyol, dan selalu mengikuti ide-ide Hidenori.'],
            ['nama' => 'Tadakuni', 'umur' => 16, 'bio' => 'Tadakuni adalah anggota trio yang paling masuk akal dan sering menjadi penengah di antara Hidenori dan Yoshitake.'],
        ];

        foreach ($castData as $data) {
            Cast::firstOrCreate(
                ['nama' => $data['nama']],
                ['umur' => $data['umur'], 'bio' => $data['bio']]
            );
        }

        $movieCastMap = [
            'Bocchi the Rock!' => ['Hitori Gotou', 'Ryou Yamada', 'Nijika Ijichi'],
            'My Deer Friend Nokotan' => ['Nokotan', 'Anya', 'Mimi'],
            'Seihantai na Kimi to Boku' => [
                'Miyu Suzuki', 'Yuusuke Tani', 'Shuuji Taira', 'Shino Azuma',
                'Kentarou Yamada', 'Natsumi Nishi', 'Rikako Honda', 'Manami Watanabe', 'Aoi Satou',
            ],
            'Danshi Koukousei no Nichijou' => ['Hidenori Tabata', 'Yoshitake Tanaka', 'Tadakuni'],
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