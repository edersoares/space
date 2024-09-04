<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entity extends Model
{
    use HasFactory;

    protected $table = 'entity';

    protected $fillable = ['label', 'slug', 'table_name', 'class', 'limit', 'max_limit'];

    /**
     * @return HasMany<Attribute>
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }
}
