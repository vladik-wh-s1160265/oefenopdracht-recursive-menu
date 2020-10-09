<?php

/**
 * Attempts to get a level recursive option from an array.
 *
 * @uses build_array_path
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
    return null;
}
