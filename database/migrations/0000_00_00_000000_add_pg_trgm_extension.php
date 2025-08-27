<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddPgTrgmExtension extends Migration
{
    public function up(): void
    {
        Schema::createExtension('pg_trgm');
    }

    public function down(): void
    {
        Schema::dropExtension('pg_trgm');
    }
}
