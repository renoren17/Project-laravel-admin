<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('roles')) {
            return;
        }

        if (!Schema::hasColumn('roles', 'nama')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->string('nama')->unique()->after('id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('roles') && Schema::hasColumn('roles', 'nama')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->dropColumn('nama');
            });
        }
    }
};
