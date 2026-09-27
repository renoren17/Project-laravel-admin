<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE films DROP FOREIGN KEY films_genre_id_foreign');
        DB::statement('ALTER TABLE films DROP COLUMN genre_id');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE films ADD genre_id BIGINT UNSIGNED NULL');

        DB::statement('
            ALTER TABLE films
            ADD CONSTRAINT films_genre_id_foreign
            FOREIGN KEY (genre_id)
            REFERENCES genres(id)
            ON DELETE SET NULL
        ');
    }
};