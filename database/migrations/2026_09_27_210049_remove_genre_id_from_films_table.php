<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('films', 'genre_id')) {
            return;
        }

        try {
            DB::statement('ALTER TABLE films DROP FOREIGN KEY films_genre_id_foreign');
        } catch (\Throwable $e) {
            // The foreign key may not exist if a previous migration already cleaned it.
        }

        DB::statement('ALTER TABLE films DROP COLUMN genre_id');
    }

    public function down(): void
    {
        if (Schema::hasColumn('films', 'genre_id')) {
            return;
        }

        DB::statement('ALTER TABLE films ADD genre_id BIGINT UNSIGNED NULL');

        try {
            DB::statement('
                ALTER TABLE films
                ADD CONSTRAINT films_genre_id_foreign
                FOREIGN KEY (genre_id)
                REFERENCES genres(id)
                ON DELETE SET NULL
            ');
        } catch (\Throwable $e) {
            // Ignore if the constraint already exists or the table state is inconsistent.
        }
    }
};