<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Orion;

use DomainException;

trait Cast
{
    /**
     * @return array<string, mixed>
     */
    public function filter(string $string): array
    {
        $data = $this->parse($string);

        $filters = [];

        $type = 'and';
        $key = '';
        $index = 0;

        foreach ($data as $item) {
            if ($item === '(') {
                $keyType = "$key$index.type";
                $key = "$key$index.nested.";
                $index = 0;
                data_set($filters, $keyType, $type);

                // Reset type to default because always the first clause will be and
                $type = 'and';

                continue;
            }

            if ($item === ')') {
                $withoutNested = substr($key, 0, -8);
                $pos = strrpos($withoutNested, '.') ?: 0;
                $key = '';
                $index = intval(substr($key, $pos)) + 1;

                // Reset type to default because always the first clause will be and
                $type = 'and';

                continue;
            }

            if (in_array($item, ['and', 'or'], true)) {
                $type = $item;
                continue;
            }

            data_set($filters, $key . $index, $this->cast($item, type: $type));

            $index++;
        }

        return $filters;
    }

    /**
     * @return array<array-key, string>
     */
    public function parse(string $string): array
    {
        $pattern = '/[a-zA-Z0-9-._]*:[a-zA-Z0-9-]*\([^])]*\)|and|or|\(|\)/';
        $data = [];

        preg_match_all($pattern, $string, $data);

        return $data[0] ?? [];
    }

    /**
     * @param array<string, string> $replaceable
     *
     * @return array<string, mixed>
     */
    public function cast(string $string, array $replaceable = [], string $type = 'and'): array
    {
        $pattern = '/([a-zA-Z0-9-._]*):([a-zA-Z0-9-]*)\((.*)\)/';

        $data = [];

        preg_match($pattern, $string, $data);

        if (empty($data)) {
            throw new DomainException("Cannot cast '$string'");
        }

        [, $field, $operator, $value] = $data;

        $value = match ($operator) {
            'in', 'not in' => str($value)->explode(',')->toArray(),
            'search' => str($value)->append('%')->prepend('%')->value(),
            default => $value,
        };

        $operator = match ($operator) {
            'is', 'eq', 'equals' => '=', // equal
            'no', 'neq', 'not-equals' => '!=', // not equal
            'lt', => '<', // less than
            'lte' => '<=', // less than or equal
            'gt' => '>', // greater than
            'gte' => '>=', // greater than or equal
            'like', 'search' => 'like', // like
            'not-like' => 'not like', // not like
            'in' => 'in', // in
            'not-in' => 'not in', // not in
            default => throw new DomainException("Unknown operator '$operator'"),
        };

        $field = $replaceable[$field] ?? $field;

        return [
            'type' => $type,
            'field' => $field,
            'operator' => $operator,
            'value' => $value,
        ];
    }
}
