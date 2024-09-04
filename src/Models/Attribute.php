<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id ID
 * @property int $entity_id ID da entidade
 * @property string $label Nome (label)
 * @property string $slug Identificador (slug)
 * @property string $column_name Nome da coluna do banco de dados
 * @property bool $is_filterable Se o atributo pode ser usado em filtros
 * @property bool $is_searchable Se o atributo pode ser usado em pesquisa
 * @property bool $is_sortable Se o atributo pode ser usado para ordenação
 * @property bool $is_includable Se o atributo pode ser usado para incluir uma relação
 * @property bool $is_relation Se o atributo é uma relação
 * @property bool $is_visible Se o atributo é visível
 * @property array $rules Regras de validação
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Entity $entity
 */
class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attribute';

    protected $fillable = [
        'entity_id',
        'label',
        'slug',
        'column_name',
        'is_filterable',
        'is_searchable',
        'is_sortable',
        'is_includable',
        'is_relation',
        'is_visible',
        'rules',
    ];

    protected $casts = [
        'is_filterable' => 'boolean',
        'is_searchable' => 'boolean',
        'is_sortable' => 'boolean',
        'is_includable' => 'boolean',
        'is_relation' => 'boolean',
        'is_visible' => 'boolean',
        'rules' => 'json',
    ];

    /**
     * @return BelongsTo<Entity, self>
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }
}
