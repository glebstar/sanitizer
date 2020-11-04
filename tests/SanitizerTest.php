<?php

use PHPUnit\Framework\TestCase;
use Glebstar\Sanitizer\Sanitizer;

class SanitizerTest extends TestCase
{
    /**
     * Test sanitize
     */
    public function testSanitize()
    {
        $s = new Sanitizer();
        $filters = ['name' => 'string'];
        $this->assertTrue($s->sanitize($filters, json_encode(['name' => 'bla']))['name'] === 'bla');

        $data = json_encode(['name' => 22]);
        $this->assertArrayHasKey('error', $s->sanitize($filters, $data));
        $this->assertTrue($s->sanitize($filters, $data)['error']['name'] === 'Parameter is not a string.');

        $filters = ['num' => 'integer'];
        $data = json_encode(['num' => '22']);
        $this->assertTrue($s->sanitize($filters, $data)['num'] === 22);

        $filters = ['dec' => 'float'];
        $data = json_encode(['dec' => '123.09']);
        $this->assertTrue($s->sanitize($filters, $data)['dec'] === 123.09);

        $filters = [
            'foo' => 'integer',
            'bar' => 'string',
            'baz' => 'phone',
        ];
        $data = json_encode([
            'foo' => '123',
            'bar' => 'asd',
            'baz' => '8 (950) 288-56-23',
        ]);

        $data = $s->sanitize($filters, $data);
        $this->assertTrue(123 === $data['foo']);
        $this->assertTrue('asd' === $data['bar']);
        $this->assertTrue('79502885623' === $data['baz']);

        $data = json_encode([
            'foo' => '123абв',
            'bar' => 'asd',
            'baz' => '260557',
        ]);

        $errors = $s->sanitize($filters, $data);
        $this->assertArrayHasKey('error', $errors);

        $this->assertTrue('Parameter is not a int.' === $errors['error']['foo']);
        $this->assertTrue('Parameter is not a phone.' === $errors['error']['baz']);
    }
}
