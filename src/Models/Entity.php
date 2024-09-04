<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id ID
 * @property string $label Nome (label)
 * @property string $slug Identificador (slug)
 * @property string $table_name Nome da tabela do banco de dados
 * @property string $class Classe (model)
 * @property int $limit Limite padrão da paginação
 * @property int $max_limit Limite máximo da paginação
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Collection<int, Attribute> $attributes
 */
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
