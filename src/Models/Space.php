<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $table = 'space';

    protected $fillable = ['name', 'authorization', 'url'];
}
