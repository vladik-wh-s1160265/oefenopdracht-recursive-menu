<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class GetRecursiveOptionTest extends TestCase
{
    private static array $options = [
        'default' => ['a' => ['b' => 'default']],
        'levels' => [
            ['a' => ['b' => 'level 0']],
            ['a' => ['b' => 'level 1']],
            ['a' => ['b' => 'level 2']],
        ]
    ];

    public function testHighLevel(): void
    {
        $this->assertEquals('level 2', get_recursive_option(self::$options, 'default', 'levels', ['a', 'b'], null, 2));
    }

    public function testNullHighLevel(): void
    {
        self::$options['levels'][2]['a']['b'] = null;
        $this->assertEquals('level 1', get_recursive_option(self::$options, 'default', 'levels', ['a', 'b'], null, 2));
    }

    public function testOnlyFirstLevel(): void
    {
        self::$options['levels'][1]['a']['b'] = null;
        self::$options['levels'][2]['a']['b'] = null;
        $this->assertEquals('level 0', get_recursive_option(self::$options, 'default', 'levels', ['a', 'b'], null, 2));
    }

    public function testDefault(): void
    {
        self::$options['levels'][0]['a']['b'] = null;
        self::$options['levels'][1]['a']['b'] = null;
        self::$options['levels'][2]['a']['b'] = null;
        $this->assertEquals('default', get_recursive_option(self::$options, 'default', 'levels', ['a', 'b'], null, 2));
    }

    public function testUseDefault(): void
    {
        self::$options['levels'][2]['a']['b'] = null;
        $this->assertEquals('default', get_recursive_option(self::$options, 'default', 'levels', ['a', 'b'], true, 2));
    }
}
