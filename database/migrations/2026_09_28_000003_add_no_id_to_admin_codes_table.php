<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('admin_codes', 'no_id')) {
            Schema::table('admin_codes', function (Blueprint $table) {
                $table->string('no_id', 50)->nullable()->after('nama');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('admin_codes', 'no_id')) {
            Schema::table('admin_codes', function (Blueprint $table) {
                $table->dropColumn('no_id');
            });
        }
    }
};
