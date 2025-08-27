<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSearchableColumnInUserTable extends Migration
{
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('searchable')->default('')->after('email');
        });

        Schema::createIndexUsingGin('user', 'searchable');
    }

    public function down(): void
    {
        Schema::dropIndexUsingGin('user', 'searchable');

        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('searchable');
        });
    }
}
