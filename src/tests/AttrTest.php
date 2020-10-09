<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class AttrTest extends TestCase {
    public function testAttr(): void
    {
        $this->assertEquals(
            'id="test-id" class="class-a class-b" data-var-a="a" data-var-b-c="b c" data="test-a test-b" required',
            attr([
                'id' => 'test-id',
                'class' => ['class-a', 'class-b'],
                'data' => ['test-a', 'test-b', 'var-a' => 'a', 'var-b-c' => ['b', 'c']],
                'required'
            ])
        );
    }
}
