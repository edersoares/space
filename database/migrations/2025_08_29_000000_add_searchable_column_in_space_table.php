<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSearchableColumnInSpaceTable extends Migration
{
    public function up(): void
    {
        Schema::table('space', function (Blueprint $table) {
            $table->string('searchable')->default('')->after('email');
        });

        Schema::createIndexUsingGin('space', 'searchable');
    }

    public function down(): void
    {
        Schema::dropIndexUsingGin('space', 'searchable');

        Schema::table('space', function (Blueprint $table) {
            $table->dropColumn('searchable');
        });
    }
}
