<?php

declare(strict_types=1);

use Dex\Laravel\Space\Extensions\Orion\Cast;

describe('Cast', function () {
    $cast = new class {
        use Cast;
    };

    test('cast default operator `name<>dex` throwing a exception', function () use ($cast) {
        $cast->cast('name<>dex');
    })->expectExceptionMessage("Cannot cast 'name<>dex'");

    test('cast default operator `name<>dex`', function () use ($cast) {
        $cast->cast('name:equal(dex)');
    })->expectExceptionMessage("Unknown operator 'equal'");

    test('cast filter `name:is(dex)`', function () use ($cast) {
        expect($cast->cast('name:is(dex)'))->toBe([
            'type' => 'and',
            'field' => 'name',
            'operator' => '=',
            'value' => 'dex',
        ]);
    });

    test('cast filter `name:eq(dex)`', function () use ($cast) {
        expect(
            $cast->cast('name:eq(dex)')
        )->toBe([
            'type' => 'and',
            'field' => 'name',
            'operator' => '=',
            'value' => 'dex',
        ]);
    });

    test('cast filter `name:equals(dex)`', function () use ($cast) {
        expect(
            $cast->cast('name:equals(dex)')
        )->toBe([
            'type' => 'and',
            'field' => 'name',
            'operator' => '=',
            'value' => 'dex',
        ]);
    });

    test('cast filter `name:no(dex)`', function () use ($cast) {
        expect(
            $cast->cast('name:no(dex)')
        )->toBe([
            'type' => 'and',
            'field' => 'name',
            'operator' => '!=',
            'value' => 'dex',
        ]);
    });

    test('cast filter `name:neq(dex)`', function () use ($cast) {
        expect(
            $cast->cast('name:neq(dex)')
        )->toBe([
            'type' => 'and',
            'field' => 'name',
            'operator' => '!=',
            'value' => 'dex',
        ]);
    });

    test('cast filter `name:not-equals(dex)`', function () use ($cast) {
        expect(
            $cast->cast('name:not-equals(dex)')
        )->toBe([
            'type' => 'and',
            'field' => 'name',
            'operator' => '!=',
            'value' => 'dex',
        ]);
    });

    test('cast filter `value:lt(10)`', function () use ($cast) {
        expect(
            $cast->cast('value:lt(10)')
        )->toBe([
            'type' => 'and',
            'field' => 'value',
            'operator' => '<',
            'value' => '10',
        ]);
    });

    test('cast filter `value:lte(10)`', function () use ($cast) {
        expect(
            $cast->cast('value:lte(10)')
        )->toBe([
            'type' => 'and',
            'field' => 'value',
            'operator' => '<=',
            'value' => '10',
        ]);
    });

    test('cast filter `value:gt(10)`', function () use ($cast) {
        expect(
            $cast->cast('value:gt(10)')
        )->toBe([
            'type' => 'and',
            'field' => 'value',
            'operator' => '>',
            'value' => '10',
        ]);
    });

    test('cast filter `value:gte(10)`', function () use ($cast) {
        expect(
            $cast->cast('value:gte(10)')
        )->toBe([
            'type' => 'and',
            'field' => 'value',
            'operator' => '>=',
            'value' => '10',
        ]);
    });

    test('cast filter `name:like(dex)`', function () use ($cast) {
        expect(
            $cast->cast('name:like(dex)')
        )->toBe([
            'type' => 'and',
            'field' => 'name',
            'operator' => 'like',
            'value' => 'dex',
        ]);
    });

    test('cast filter `name:not-like(dex)`', function () use ($cast) {
        expect(
            $cast->cast('name:not-like(dex)')
        )->toBe([
            'type' => 'and',
            'field' => 'name',
            'operator' => 'not like',
            'value' => 'dex',
        ]);
    });

    test('cast filter `value:in(1,2,3)`', function () use ($cast) {
        expect(
            $cast->cast('value:in(1,2,3)')
        )->toBe([
            'type' => 'and',
            'field' => 'value',
            'operator' => 'in',
            'value' => ['1', '2', '3'],
        ]);
    });

    test('cast filter `value:not-in(1,2,3)`', function () use ($cast) {
        expect(
            $cast->cast('value:not-in(1,2,3)')
        )->toBe([
            'type' => 'and',
            'field' => 'value',
            'operator' => 'not in',
            'value' => ['1', '2', '3'],
        ]);
    })->only();

    test('parse `name:is(dex) name:is(framework)`', function () use ($cast) {
        expect($cast->parse('name:is(dex) name:is(framework)'))->toBe([
            'name:is(dex)',
            'name:is(framework)',
        ]);
    });

    test('parse `name:is(dex) and name:is(framework)`', function () use ($cast) {
        expect($cast->parse('name:is(dex) and name:is(framework)'))->toBe([
            'name:is(dex)',
            'and',
            'name:is(framework)',
        ]);
    });

    test('parse `name:is(Eder Soares) and name:is(Dex Framework)`', function () use ($cast) {
        expect($cast->parse('name:is(Eder Soares) and name:is(Dex Framework)'))->toBe([
            'name:is(Eder Soares)',
            'and',
            'name:is(Dex Framework)',
        ]);
    });

    test('parse `(name:is(a) and age:is(17)) or (name:is(b) and age:is(7))`', function () use ($cast) {
        expect($cast->parse('(name:is(a) and age:is(17)) or (name:is(b) and age:is(7))'))->toBe([
            '(',
            'name:is(a)',
            'and',
            'age:is(17)',
            ')',
            'or',
            '(',
            'name:is(b)',
            'and',
            'age:is(7)',
            ')',
        ]);
    });

    test('parse `name:is( and ) or name:is( or )`', function () use ($cast) {
        expect($cast->parse('name:is( and ) or name:is( or )'))->toBe([
            'name:is( and )',
            'or',
            'name:is( or )',
        ]);
    });

    test('cast filter structure', function () use ($cast) {
        expect($cast->filter('(id:in(1,2,3) and created_at:is(2024-01-01)) or (name:like(Brasil) and created_at:is(2024-01-01))'))->toBe([
            [
                'type' => 'and',
                'nested' => [
                    [
                        'type' => 'and',
                        'field' => 'id',
                        'operator' => 'in',
                        'value' => ['1', '2', '3'],
                    ],
                    [
                        'type' => 'and',
                        'field' => 'created_at',
                        'operator' => '=',
                        'value' => '2024-01-01',
                    ],
                ],
            ],
            [
                'type' => 'or',
                'nested' => [
                    [
                        'type' => 'and',
                        'field' => 'name',
                        'operator' => 'like',
                        'value' => 'Brasil',
                    ],
                    [
                        'type' => 'and',
                        'field' => 'created_at',
                        'operator' => '=',
                        'value' => '2024-01-01',
                    ],
                ],
            ],
        ]);
    });

    test('cast filter structure using `or` inside parentheses', function () use ($cast) {
        expect($cast->filter('(id:in(1,2,3) or created_at:is(2024-01-01)) and (name:like(Brasil) or created_at:is(2024-01-01))'))->toBe([
            [
                'type' => 'and',
                'nested' => [
                    [
                        'type' => 'and',
                        'field' => 'id',
                        'operator' => 'in',
                        'value' => ['1', '2', '3'],
                    ],
                    [
                        'type' => 'or',
                        'field' => 'created_at',
                        'operator' => '=',
                        'value' => '2024-01-01',
                    ],
                ],
            ],
            [
                'type' => 'and',
                'nested' => [
                    [
                        'type' => 'and',
                        'field' => 'name',
                        'operator' => 'like',
                        'value' => 'Brasil',
                    ],
                    [
                        'type' => 'or',
                        'field' => 'created_at',
                        'operator' => '=',
                        'value' => '2024-01-01',
                    ],
                ],
            ],
        ]);
    });

    test('cast filter structure double nested', function () use ($cast) {
        expect($cast->filter('((id:in(1,2,3) or created_at:is(2024-01-01))) and (name:like(Brasil) or created_at:is(2024-01-01))'))->toBe([
            [
                'type' => 'and',
                'nested' => [
                    [
                        'type' => 'and',
                        'nested' => [
                            [
                                'type' => 'and',
                                'field' => 'id',
                                'operator' => 'in',
                                'value' => ['1', '2', '3'],
                            ],
                            [
                                'type' => 'or',
                                'field' => 'created_at',
                                'operator' => '=',
                                'value' => '2024-01-01',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'and',
                'nested' => [
                    [
                        'type' => 'and',
                        'field' => 'name',
                        'operator' => 'like',
                        'value' => 'Brasil',
                    ],
                    [
                        'type' => 'or',
                        'field' => 'created_at',
                        'operator' => '=',
                        'value' => '2024-01-01',
                    ],
                ],
            ],
        ]);
    });

    test('cast filter structure triple nested', function () use ($cast) {
        expect($cast->filter('(((id:in(1,2,3) or created_at:is(2024-01-01)))) and (name:like(Brasil) or created_at:is(2024-01-01))'))->toBe([
            [
                'type' => 'and',
                'nested' => [
                    [
                        'type' => 'and',
                        'nested' => [
                            [
                                'type' => 'and',
                                'nested' => [
                                    [
                                        'type' => 'and',
                                        'field' => 'id',
                                        'operator' => 'in',
                                        'value' => ['1', '2', '3'],
                                    ],
                                    [
                                        'type' => 'or',
                                        'field' => 'created_at',
                                        'operator' => '=',
                                        'value' => '2024-01-01',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'and',
                'nested' => [
                    [
                        'type' => 'and',
                        'field' => 'name',
                        'operator' => 'like',
                        'value' => 'Brasil',
                    ],
                    [
                        'type' => 'or',
                        'field' => 'created_at',
                        'operator' => '=',
                        'value' => '2024-01-01',
                    ],
                ],
            ],
        ]);
    });
});

describe('Controller', function () {
    test()->post('/api/demo', [
        'name' => 'Demo',
    ])->assertCreated();
});
