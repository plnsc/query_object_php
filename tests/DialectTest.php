<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;

class DialectChildMock extends Dialect
{}

/**
 * @covers \pnasc\Dialect
 */
class DialectTest extends TestCase
{
    public function test_wrapper()
    {
        $dialect = new DialectChildMock();

        $this->assertEquals("'my_string'",
            $dialect->wrapper("string", "my_string"));
    }

    public function test_sanitize_value()
    {
        $dialect = new DialectChildMock();

        $this->assertEquals("NULL",
            $dialect->sanitize_value(null));
    }
}
