<?php

/**
 * Attempts to get a value from an array from a path array.
 *
 * @uses gettype, array_key_exists
 *
 * @param $a
 * @param array $p
 * @return mixed|null
 */
function build_array_path($a, array $p)
{
    if (gettype($a) == 'string') {
        return null;
    }

    foreach ($p as $v) {
        if (array_key_exists($v, gettype($a) == 'array' ? $a : [])) {
            $a = $a[$v];
        } else {
            return $a = null;
        }
    }

    return $a;
}