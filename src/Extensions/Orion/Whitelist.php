<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Orion;

use Dex\Laravel\Space\Models\Attribute;
use Dex\Laravel\Space\Models\Entity;
use Orion\Http\Controllers\Controller as OrionController;

/**
 * @mixin OrionController
 */
trait Whitelist
{
    protected ?Entity $entity;

    /**
     * The list of available query scopes.
     */
    public function exposedScopes(): array
    {
        return [];
    }

    /**
     * The attributes that are used for filtering.
     */
    public function filterableBy(): array
    {
        if (empty($this->entity())) {
            return parent::filterableBy();
        }

        return $this->entity()
            ->attributes
            ->filter(fn (Attribute $attribute) => $attribute->is_filterable)
            ->map(fn (Attribute $attribute) => $attribute->column_name)
            ->toArray();
    }

    /**
     * The relations that are allowed to be aggregated with a resource.
     */
    public function aggregates(): array
    {
        return [];
    }

    /**
     * The attributes from filterableBy method that have "scoped"
     * filter options included in the response.
     */
    public function scopedFilters(): array
    {
        return []; // @codeCoverageIgnore
    }

    /**
     * The attributes that are used for sorting.
     */
    public function sortableBy(): array
    {
        if (empty($this->entity())) {
            return parent::sortableBy();
        }

        return $this->entity()
            ->attributes
            ->filter(fn (Attribute $attribute) => $attribute->is_sortable)
            ->map(fn (Attribute $attribute) => $attribute->column_name)
            ->toArray();
    }

    /**
     * The relations that are allowed to be included together with a resource.
     */
    public function includes(): array
    {
        if (empty($this->entity())) {
            return parent::includes();
        }

        return $this->entity()
            ->attributes
            ->filter(fn (Attribute $attribute) => $attribute->is_includable)
            ->map(fn (Attribute $attribute) => $attribute->column_name)
            ->toArray();
    }

    /**
     * The relations that are always included together with a resource.
     */
    public function alwaysIncludes(): array
    {
        if (empty($this->entity())) {
            return parent::alwaysIncludes();
        }

        return [];
    }

    /**
     * Default pagination limit.
     */
    public function limit(): int
    {
        if (empty($this->entity())) {
            return parent::limit();
        }

        return $this->entity()->limit;
    }

    /**
     * Max pagination limit.
     */
    public function maxLimit(): ?int
    {
        if (empty($this->entity())) {
            return parent::maxLimit();
        }

        return $this->entity()->max_limit;
    }

    /**
     * The attributes that are used for searching.
     */
    public function searchableBy(): array
    {
        if (empty($this->entity())) {
            return parent::searchableBy();
        }

        return $this->entity()
            ->attributes
            ->filter(fn (Attribute $attribute) => $attribute->is_searchable)
            ->map(fn (Attribute $attribute) => $attribute->column_name)
            ->toArray();
    }

    protected function entity(): ?Entity
    {
        if (empty($this->entity)) {
            $this->entity = Entity::query()
                ->with('attributes')
                ->where('class', $this->getModel())
                ->first();
        }

        return $this->entity;
    }
}
