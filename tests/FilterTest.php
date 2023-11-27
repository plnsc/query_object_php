<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;

/**
 * @covers \pnasc\Filter
 */
class FilterTest extends TestCase
{
    public function test_list()
    {
        $expected = "some_list_here IN ('mc','hc','mt','ht','nb')";
        $filter = new Filter('some_list_here', 'IN', array('mc', 'hc', 'mt', 'ht', 'nb'));
        $this->assertEquals($expected, $filter->dump());
    }

    public function test_string()
    {
        $expected = "thats_a_string = '2023-11-26'";
        $filter = new Filter('thats_a_string', '=', '2023-11-26');
        //
        $this->assertEquals($expected, $filter->dump());
    }

    public function test_integer()
    {
        $expected = 'integer_column_name > 13000';
        $filter = new Filter('integer_column_name', '>', 13000);
        $this->assertEquals($expected, $filter->dump());
    }

    public function test_null()
    {
        $expected = 'are_you_sure IS NOT NULL';
        $filter = new Filter('are_you_sure', 'IS NOT', null);
        $this->assertEquals($expected, $filter->dump());
    }

    public function test_bool()
    {
        $expected = 'period = TRUE';
        $filter = new Filter('period', '=', true);
        $this->assertEquals($expected, $filter->dump());
    }
}
