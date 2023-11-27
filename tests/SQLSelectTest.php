<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;

/**
 * @covers \pnasc\SQLSelect
 */
class SQLSelectTest extends TestCase
{

    public function test_statement()
    {
        $result  = "SELECT id, name, gender FROM gen_z_names";
        $result .= " WHERE (name LIKE 'enzo%' AND name LIKE 'valentina%') ORDER BY name LIMIT 10 OFFSET 0";

        $criteria = new Criteria;
        $criteria->add(new Filter('name', 'LIKE', 'enzo%'));
        $criteria->add(new Filter('name', 'LIKE', 'valentina%'));
        $criteria->set_property('offset', 0);
        $criteria->set_property('limit', 10);
        $criteria->set_property('order', 'name');

        $statement = new SQLSelect;
        $statement->set_entity('gen_z_names');
        $statement->add_column('id');
        $statement->add_column('name');
        $statement->add_column('gender');
        $statement->set_criteria($criteria);

        $this->assertEquals($result, $statement->get_statement());
    }
}