<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Orion;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use JsonException;
use Orion\Contracts\QueryBuilder as OrionQueryBuilderContract;
use Orion\Drivers\Standard\QueryBuilder as OrionQueryBuilder;
use Orion\Http\Requests\Request;

class QueryBuilder extends OrionQueryBuilder implements OrionQueryBuilderContract
{
    /**
     * Get Eloquent query builder for the model and apply filters, searching and sorting.
     *
     * @param  Builder<Model>|Relation<Model>  $query
     * @return Builder<Model>|Relation<Model>
     *
     * @throws JsonException
     */
    public function buildQuery($query, Request $request)
    {
        $actionMethod = $request->route()?->getActionMethod();

        /**
         * See differences between this and default controller.
         *
         * @see OrionQueryBuilder::buildQuery
         */
        if (in_array($actionMethod, ['index', 'search', 'show'], true)) {
            $this->applyScopesToQuery($query, $request);
            $this->applyFiltersToQuery($query, $request);
            $this->applySearchingToQuery($query, $request);
            $this->applySortingToQuery($query, $request); // @phpstan-ignore-line
            $this->applySoftDeletesToQuery($query, $request);
        }

        $this->applyIncludesToQuery($query, $request);
        $this->applyAggregatesToQuery($query, $request);

        return $query;
    }
}
