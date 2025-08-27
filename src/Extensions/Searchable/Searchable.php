<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Searchable;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait Searchable
{
    public function searchableBy(): array
    {
        return [
            $this->getKeyName(),
        ];
    }

    public function searchableKey(): string
    {
        return 'searchable';
    }

    public function searchableValue(Model $model): string
    {
        $attributes = $model->only($this->searchableBy());
        $searchable = implode(' ', $attributes);

        return str($searchable)->slug(' ')->value();
    }

    public static function bootSearchable(): void
    {
        static::saving(function (Model $model) {
            /** @var Searchable $searchable */
            $searchable = $model;

            $model->{$searchable->searchableKey()} = $searchable->searchableValue($model);
        });
    }
}
