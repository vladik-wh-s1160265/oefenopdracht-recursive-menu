<?php

$options = [
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

echo(render_menu($recursive_menu, $options));
