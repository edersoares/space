<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $table = 'space';

    protected $fillable = ['name', 'authorization', 'url'];
}
