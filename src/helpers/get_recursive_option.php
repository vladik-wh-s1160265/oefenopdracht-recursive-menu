<?php

/**
 * Attempts to get a level recursive option from an array.
 *
 * @param array $options The options object.
 * @param string $default_key Default options key.
 * @param string $recursive_key Key that points to an array of index levels.
 * @param array $path The array key path.
 * @param bool $use_default Whether to fallback to default or use previous iteration
 * @param int $iteration The current iteration level.
 * @return mixed
 */
function get_recursive_option(array $options, string $default_key, string $recursive_key, array $path, ?bool $use_default = false, int $iteration = 0)
{
    $tmp = $options[$recursive_key][$iteration] ?? null;

    while ($iteration >= 0) {
        if (($tmp = build_array_path($tmp, $path)) !== null) {
            break;
        } else {
            if ($use_default) {
                $tmp = null;

                break;
            }

            $iteration--;

            $tmp = $options[$recursive_key][$iteration] ?? null;
        }
    }

    return $tmp ?? build_array_path($options[$default_key], $path);
}
