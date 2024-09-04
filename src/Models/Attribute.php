<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attribute';

    protected $fillable = [
        'entity_id',
        'name',
        'slug',
        'column_name',
        'is_filterable',
        'is_searchable',
        'is_sortable',
        'is_includable',
        'is_relation',
    ];

    /**
     * @return BelongsTo<Entity, self>
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }
}
