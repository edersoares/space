<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Permission;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as Model;

class Permission extends Model
{
    use HasFactory;
    use HasUuids;
}
