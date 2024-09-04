<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Orion;

use Dex\Laravel\Space\Models\Attribute;
use Dex\Laravel\Space\Models\Entity;
use Orion\Http\Requests\Request as OrionRequest;

class Request extends OrionRequest
{
    protected ?Entity $entity;

    protected function entity(): ?Entity
    {
        if (empty($this->entity)) {
            $model = $this->route()->getController()->getModel();

            $this->entity = Entity::query()
                ->with('attributes')
                ->where('class', $model)
                ->first();
        }

        return $this->entity;
    }

    public function commonRules(): array
    {
        if (empty($this->entity())) {
            return parent::commonRules();
        }

        return $this->entity()
            ->attributes
            ->mapWithKeys(fn (Attribute $attribute) => [
                $attribute->column_name => $attribute->rules,
            ])
            ->toArray();
    }
}
