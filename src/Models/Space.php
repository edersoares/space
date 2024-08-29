<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use Dex\Laravel\Space\Database\Factories\SpaceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    /** @use HasFactory<SpaceFactory> */
    use HasFactory;

    protected $table = 'space';
}
