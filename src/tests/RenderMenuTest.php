<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class RenderMenuTest extends TestCase
{
    private static string $expected_html = <<<EOT
<li id="item-1" class="item-level-1" data-id="1" data-level="1"><h1 class="title">A /a</h1></li><li id="item-2" class="item-level-1 item-parent" data-id="2" data-level="1"><h1 class="title">B /b&rarr;</h1><div class="main-menu"><ul><li id="item-3" class="item-level-2" data-id="3" data-level="2"><h2 class="title">BA /b/a</h2></li><li id="item-4" class="item-level-2" data-id="4" data-level="2"><h2 class="title">BB /b/b</h2></li></ul></div></li><li id="item-5" class="item-level-1 item-parent" data-id="5" data-level="1"><h1 class="title">C /c&rarr;</h1><div class="main-menu"><ul><li id="item-6" class="item-level-2 item-parent" data-id="6" data-level="2"><h2 class="title">CA /c/a&rarr;</h2><div class="sub-menu"><ul><li id="item-7" class="item-level-3 item-parent" data-id="7" data-level="3"><h3 class="title">CAA /c/a/a&rarr;</h3><div class="sub-menu"><ul><li id="item-8" class="item-level-4" data-id="8" data-level="4"><h3 class="title">CAAA /c/a/a/a</h3></li></ul></div></li><li id="item-9" class="item-level-3" data-id="9" data-level="3"><h3 class="title">CAB /c/a/b</h3></li></ul></div></li><li id="item-10" class="item-level-2" data-id="10" data-level="2"><h2 class="title">CB /c/b</h2></li></ul></div></li>
EOT;

    private static array $options = [
        'use_default' => false,
        'data' => ['id', 'name', 'link'],
        'items_key' => '_items',
        'levels_markup_default' => [
            'item' => [
                'default' => [
                    'start' => '<li %1$s><div class="title">%4$s %5$s</div>',
                    'end' => '</li>',
                    'attr' => [
                        'id' => 'item-%3$s',
                        'class' => [
                            'item-level-%2$s'
                        ],
                        'data' => [
                            'id' => '%3$s',
                            'level' => '%2$s',
                        ],
                    ],
                ],
                'children' => [
                    'start' => '<li %1$s><div class="title">%4$s %5$s&rarr;</div>',
                    'end' => '</li>',
                    'attr' => [
                        'id' => 'item-%3$s',
                        'class' => [
                            'item-level-%2$s',
                            'item-parent'
                        ],
                        'data' => [
                            'id' => '%3$s',
                            'level' => '%2$s',
                        ],
                    ],
                ]
            ],
            'children' => [
                'before' => '<ul>',
                'after' => '</ul>',
            ]
        ],
        'levels_markup' => [
            [
                'item' => [
                    'default' => [
                        'start' => '<li %1$s><h1 class="title">%4$s %5$s</h1>',
                        'end' => '</li>',
                    ],
                    'children' => [
                        'start' => '<li %1$s><h1 class="title">%4$s %5$s&rarr;</h1>',
                        'end' => '</li>',
                    ],
                ],
                'children' => [
                    'before' => '<div class="main-menu"><ul>',
                    'after' => '</ul></div>',
                ],
            ],
            [
                'item' => [
                    'default' => [
                        'start' => '<li %1$s><h2 class="title">%4$s %5$s</h2>',
                        'end' => '</li>',
                    ],
                    'children' => [
                        'start' => '<li %1$s><h2 class="title">%4$s %5$s&rarr;</h2>',
                        'end' => '</li>',
                    ],
                ],
                'children' => [
                    'before' => '<div class="sub-menu"><ul>',
                    'after' => '</ul></div>',
                ],
            ],
            [
                'item' => [
                    'default' => [
                        'start' => '<li %1$s><h3 class="title">%4$s %5$s</h3>',
                        'end' => '</li>',
                    ],
                    'children' => [
                        'start' => '<li %1$s><h3 class="title">%4$s %5$s&rarr;</h3>',
                        'end' => '</li>',
                    ],
                ],
                'children' => [

                ],
            ],
        ],
    ];

    public function testRenderMenu(): void {
        $menu = [
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

        $recursive_menu = generate_recursive_array($menu, [
            'id_key' => 'id',
            'parent_key' => 'parent',
            'items_key' => '_items',
            'data' => ['id', 'name', 'link']
        ]);

        $this->assertEquals(self::$expected_html, render_menu($recursive_menu, self::$options));
    }
}
