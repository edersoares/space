<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeTable extends Migration
{
    public function up(): void
    {
        Schema::create('attribute', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id');
            $table->string('label');
            $table->string('slug');
            $table->string('column_name');
            $table->boolean('is_filterable')->default(false);
            $table->boolean('is_searchable')->default(false);
            $table->boolean('is_sortable')->default(false);
            $table->boolean('is_includable')->default(false);
            $table->boolean('is_relation')->default(false);
            $table->json('rules')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attribute');
    }
}
