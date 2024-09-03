<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Orion;

use Orion\Http\Requests\Request;

trait FluentQuery
{
    use Cast;

    /**
     * @return array<string, string>
     */
    protected function replaceableBy(): array
    {
        return [];
    }

    protected function setFilterQuery(Request $request): void
    {
        $filter = $request->string('filter');

        if ($filter->isEmpty()) {
            return;
        }

        $filters = $this->filter($filter->value());

        $request->query->remove('filter');
        $request->query->set('filters', $filters);
    }

    protected function setSearchQuery(Request $request): void
    {
        $search = $request->string('search');

        if ($search->isEmpty()) {
            return;
        }

        $request->query->remove('search');
        $request->request->set('search', [
            'value' => $search->slug(' ')->value(),
        ]);
    }

    protected function setShowQuery(Request $request): void
    {
        $show = $request->integer('show');

        if (empty($show)) {
            return;
        }

        $request->query->remove('show');
        $request->query->set('limit', $show);
    }

    protected function setSortQuery(Request $request): void
    {
        $replaceable = $this->replaceableBy();

        $sort = $request->string('sort');

        if ($sort->isEmpty()) {
            return;
        }

        $sort = $sort->explode(' ')->map(function ($item) use ($replaceable) {
            [$field, $direction] = explode(':', $item . ':asc');

            return [
                'field' => $replaceable[$field] ?? $field,
                'direction' => $direction,
            ];
        })->toArray();

        $request->query->remove('sort');
        $request->query->set('sort', $sort);
    }
}
