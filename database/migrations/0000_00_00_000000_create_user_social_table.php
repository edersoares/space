<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSocialTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_social', function (Blueprint $table) {
            $table->id();
            $table->string('provider')->index();
            $table->string('provider_id')->index();
            $table->string('user_id')->index();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('nickname')->nullable();
            $table->text('avatar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_social');
    }
}
