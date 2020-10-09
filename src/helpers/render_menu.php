<?php

/**
 * Renders menu from hierarchical menu array.
 *
 * @uses vsprintf, attr, get_recursive_option, render_menu
 *
 * @param array $menu Hierarchical menu
 * @param array $options Options object
 * @param int $level Iteration level. Needed for self invoking functionality
 * @return string
 */
function render_menu(array $menu = [], array $options = [], int $level = 1): string
{
    $str = '';

    foreach ($menu as $k => $v) {
        $recursive_options = [
            $options,
            'levels_markup_default',
            'levels_markup',
            [],
            $options['use_default'] ?? false,
            $level - 1
        ];

        $data = [
            '',
            $level,
        ];

        foreach ($options['data'] ?? [] as $d) {
            $data[$d] = $v[$d];
        }

        $items_key = $options['items_key'] ?? '_items';

        $children_or_default = $v[$items_key] ?? false ? 'children' : 'default';
        $recursive_options[3] = ['item', $children_or_default, 'attr'];

        $data[0] = vsprintf(attr(get_recursive_option(...$recursive_options)), $data);

        $recursive_options[3][2] = 'start';
        $str .= vsprintf(get_recursive_option(...$recursive_options), $data);

        if ($v[$items_key] ?? false) {
            $recursive_options[3] = ['children', 'before'];
            $str .= get_recursive_option(...$recursive_options);
            $str .= render_menu($v[$items_key], $options, $level + 1);
            $recursive_options[3][1] = 'after';
            $str .= get_recursive_option(...$recursive_options);
        }

        $recursive_options[3] = ['item', $children_or_default, 'end'];
        $str .= get_recursive_option(...$recursive_options);
    }

    return $str;
}
