<?php

/**
 * Generates a hierarchical array based on parent key of a normal array.
 *
 * @param array $menu
 * @param array $options
 * @param int|null $parent
 * @return array|null
 */
function generate_recursive_array(array $menu, array $options = [], int $parent = null)
{
    $m = [];

    foreach ($menu as $v) {
        if ($v[$options['parent_key'] ?? 'parent'] === $parent) {
            $a = [$options['items_key'] ?? '_items' => generate_recursive_array($menu, $options, $v[$options['id_key'] ?? 'id'])];

            foreach ($options['data'] ?? [] as $d) {
                $a[$d] = $v[$d];
            }

            $m [] = $a;
        }
    }

    return count($m) ? $m : null;
}
