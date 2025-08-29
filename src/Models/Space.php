<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use DateTime;
use Dex\Laravel\Space\Extensions\Searchable\Searchable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $authorization
 * @property string $url
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property DateTime $softDeletes
 */
class Space extends Model
{
    use HasFactory;
    use HasUuids;
    use Searchable;

    protected $table = 'space';

    protected $fillable = ['name', 'authorization', 'url', 'additional'];

    protected $casts = [
        'additional' => 'json',
    ];

    public function searchableBy(): array
    {
        return ['name'];
    }

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
