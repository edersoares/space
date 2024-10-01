<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysInProfileTable extends Migration
{
    public function up(): void
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->foreign(['space_id'])->on('space')->references('id');
            $table->foreign(['user_id'])->on('user')->references('id');
        });
    }

    public function down(): void
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->dropForeign(['space_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
