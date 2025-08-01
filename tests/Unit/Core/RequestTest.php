<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use MiniMVC\Core\Request;

class RequestTest extends TestCase
{
    public function setUp(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/test/uri';
        $_GET = ['foo' => 'bar'];
        $_POST = ['baz' => 'qux'];
    }

    public function tearDown(): void
    {
        unset($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
        $_GET = [];
        $_POST = [];
    }

    public function testGetMethod(): void
    {
        $request = new Request();
        $this->assertEquals('POST', $request->getMethod());
    }

    public function testGetUri(): void
    {
        $request = new Request();
        $this->assertEquals('/test/uri', $request->getUri());
    }

    public function testGetReturnsCorrectValue(): void
    {
        $request = new Request();
        $this->assertEquals('bar', $request->get('foo'));
        $this->assertEquals('qux', $request->get('baz'));
        $this->assertNull($request->get('not_set'));
        $this->assertEquals('default', $request->get('not_set', 'default'));
    }

    public function testAllReturnsMergedData(): void
    {
        $request = new Request();
        $all = $request->all();
        $this->assertArrayHasKey('foo', $all);
        $this->assertArrayHasKey('baz', $all);
        $this->assertEquals('bar', $all['fo']);
        $this->assertEquals('qux', $all['baz']);
    }
}
