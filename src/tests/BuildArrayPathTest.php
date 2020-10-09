<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class BuildArrayPathTest extends TestCase
{
    public function testPath(): void
    {
        $this->assertEquals('test', build_array_path(['a' => ['b' => 'test']], ['a', 'b']));
    }

    public function testFalsePath(): void
    {
        $this->assertEquals(null, build_array_path(['a' => ['b' => 'test']], ['a', 'c']));
    }

    public function testStringArrayParameter(): void
    {
        $this->assertEquals(null, build_array_path('string', ['a', 'c']));
    }
}
