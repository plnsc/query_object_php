<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;
use \ReflectionClass;

/**
 * @covers \pnasc\Filter
 */
class FilterTest extends TestCase
{

    public function assertPrivateProperty($expected, $object, $property_name, )
    {
        $reflector = new ReflectionClass($object);
        $property = $reflector->getProperty($property_name);
        $property->setAccessible(true);

        $this->assertEquals($expected, $property->getValue($object));
    }

    public function test_dump()
    {
        $expected = "thats_a_column = NULL";
        $filter = new Filter('thats_a_column', '=', null);
        $this->assertEquals($expected, $filter->dump());
    }

    public function test_equals()
    {
        $expected_operator = '=';
        $filter = Filter::equals(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_not_equals()
    {
        $expected_operator = '<>';
        $filter = Filter::not_equals(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_is()
    {
        $expected_operator = 'IS';
        $filter = Filter::is(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_is_not()
    {
        $expected_operator = 'IS NOT';
        $filter = Filter::is_not(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_like()
    {
        $expected_operator = 'LIKE';
        $filter = Filter::like(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_not_like()
    {
        $expected_operator = 'NOT LIKE';
        $filter = Filter::not_like(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_in()
    {
        $expected_operator = 'IN';
        $filter = Filter::in(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_not_in()
    {
        $expected_operator = 'NOT IN';
        $filter = Filter::not_in(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_lt()
    {
        $expected_operator = '<';
        $filter = Filter::lt(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_lt_equals()
    {
        $expected_operator = '<=';
        $filter = Filter::lt_equals(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_gt()
    {
        $expected_operator = '>';
        $filter = Filter::gt(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }

    public function test_gt_equals()
    {
        $expected_operator = '>=';
        $filter = Filter::gt_equals(null, null);
        $this->assertPrivateProperty($expected_operator, $filter, 'operator');
    }
}
