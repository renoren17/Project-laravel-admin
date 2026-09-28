<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('films', 'trailer_url')) {
            return;
        }

        Schema::table('films', function (Blueprint $table) {
            $table->text('trailer_url')
                ->nullable()
                ->after('poster');
        });
    }

    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn('trailer_url');
        });
    }
};