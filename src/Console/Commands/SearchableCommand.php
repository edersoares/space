<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Console\Commands;

use Dex\Laravel\Space\Extensions\Searchable\Searchable;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class SearchableCommand extends Command
{
    protected $signature = 'searchable {model}';

    protected $description = 'Fill searchable column for model';

    public function handle(): int
    {
        $class = $this->argument('model');

        if (false === class_exists($class)) {
            $this->error("Model [$class] not found");

            return self::INVALID;
        }

        $traits = class_uses_recursive($class);

        if (false === in_array(Searchable::class, $traits)) {
            $this->error("Model [$class] does not implement [Searchable] trait");

            return self::INVALID;
        }

        $query = $class::query();

        /** @var Model $model */
        foreach ($query->cursor() as $model) {
            /** @var Searchable $searchable */
            $searchable = $model;

            $model->update([
                $searchable->searchableKey() => $searchable->searchableValue($model),
            ]);
        }

        return self::SUCCESS;
    }
}
