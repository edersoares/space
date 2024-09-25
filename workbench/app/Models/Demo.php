<?php

declare(strict_types=1);

namespace Workbench\Dex\Laravel\Space\App\Models;

use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    protected $table = 'demo';

    protected $fillable = ['name'];
}
