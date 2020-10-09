<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class GenerateRecursiveArrayTest extends TestCase
{
    private static array $original_menu = [
        ['id' => 1, 'name' => 'A', 'link' => '/a', 'parent' => null],
        ['id' => 2, 'name' => 'B', 'link' => '/b', 'parent' => null],
        ['id' => 3, 'name' => 'BA', 'link' => '/b/a', 'parent' => 2],
        ['id' => 4, 'name' => 'BB', 'link' => '/b/b', 'parent' => 2],
        ['id' => 5, 'name' => 'C', 'link' => '/c', 'parent' => null],
        ['id' => 6, 'name' => 'CA', 'link' => '/c/a', 'parent' => 5],
        ['id' => 7, 'name' => 'CAA', 'link' => '/c/a/a', 'parent' => 6],
        ['id' => 8, 'name' => 'CAAA', 'link' => '/c/a/a/a', 'parent' => 7],
        ['id' => 9, 'name' => 'CAB', 'link' => '/c/a/b', 'parent' => 6],
        ['id' => 10, 'name' => 'CB', 'link' => '/c/b', 'parent' => 5],
    ];

    private static array $converted_menu = [
        0 =>
            [
                '_items' => NULL,
                'id' => 1,
                'name' => 'A',
                'link' => '/a',
            ],
        1 =>
            [
                '_items' =>
                    [
                        0 =>
                            [
                                '_items' => NULL,
                                'id' => 3,
                                'name' => 'BA',
                                'link' => '/b/a',
                            ],
                        1 =>
                            [
                                '_items' => NULL,
                                'id' => 4,
                                'name' => 'BB',
                                'link' => '/b/b',
                            ],
                    ],
                'id' => 2,
                'name' => 'B',
                'link' => '/b',
            ],
        2 =>
            [
                '_items' =>
                    [
                        0 =>
                            [
                                '_items' =>
                                    [
                                        0 =>
                                            [
                                                '_items' =>
                                                    [
                                                        0 =>
                                                            [
                                                                '_items' => NULL,
                                                                'id' => 8,
                                                                'name' => 'CAAA',
                                                                'link' => '/c/a/a/a',
                                                            ],
                                                    ],
                                                'id' => 7,
                                                'name' => 'CAA',
                                                'link' => '/c/a/a',
                                            ],
                                        1 =>
                                            [
                                                '_items' => NULL,
                                                'id' => 9,
                                                'name' => 'CAB',
                                                'link' => '/c/a/b',
                                            ],
                                    ],
                                'id' => 6,
                                'name' => 'CA',
                                'link' => '/c/a',
                            ],
                        1 =>
                            [
                                '_items' => NULL,
                                'id' => 10,
                                'name' => 'CB',
                                'link' => '/c/b',
                            ],
                    ],
                'id' => 5,
                'name' => 'C',
                'link' => '/c',
            ],
    ];

    public function testConversion(): void
    {
        $this->assertEquals(self::$converted_menu, generate_recursive_array(self::$original_menu, [
            'id_key' => 'id',
            'parent_key' => 'parent',
            'items_key' => '_items',
            'data' => ['id', 'name', 'link']
        ]));
    }
}
