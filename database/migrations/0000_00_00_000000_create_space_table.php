<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpaceTable extends Migration
{
    public function up(): void
    {
        Schema::create('space', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('authorization');
            $table->text('url');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('space');
    }
}
