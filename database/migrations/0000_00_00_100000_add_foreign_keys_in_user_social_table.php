<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysInUserSocialTable extends Migration
{
    public function up(): void
    {
        Schema::table('user_social', function (Blueprint $table) {
            $table->foreign(['user_id'])->on('user')->references('id');
        });
    }

    public function down(): void
    {
        Schema::table('user_social', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
