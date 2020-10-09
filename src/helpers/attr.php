<?php

declare(strict_types=1);

/**
 * Generates HTML element attributes based on $attr options.
 *
 * @uses gettype, \count, implode, trim
 *
 * @param array $attr
 * @return string
 */
function attr(array $attr): string
{
    $str = '';

    foreach ($attr as $k => $v) {
        switch (gettype($v)) {
            case ('string'):
                if (gettype($k) == 'string') {
                    $str .= " $k=\"$v\"";
                } else {
                    $str .= " $v";
                }
                break;
            case ('array'):
                $classes = [];

                foreach ($v as $k2 => $v2) {
                    if (gettype($k2) == 'integer') {
                        $classes [] = $v2;
                    } else {
                        if (gettype($v2) == 'array') {
                            $c = implode(' ', $v2);
                            $str .= " $k-$k2=\"$c\"";
                        } else {
                            $str .= " $k-$k2=\"$v2\"";
                        }
                    }
                }

                if (count($classes)) {
                    $c = implode(' ', $classes);
                    $str .= " $k=\"$c\"";
                }
                break;
        }
    }

    return trim($str);
}
