<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Permission;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    use HasFactory;
    use HasUuids;
}
