<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;

/**
 * @covers \pnasc\SQLSelect
 */
class SelectTest extends TestCase
{

    public function test_statement()
    {
        $result = "SELECT id, name, gender FROM gen_z_names";
        $result .= " WHERE (name LIKE 'enzo%' AND name LIKE 'valentina%')";
        $result .= " ORDER BY id ASC, name DESC LIMIT 10 OFFSET 0;";

        $criteria = new Criteria;
        $criteria->add(Filter::like('name', 'enzo%'));
        $criteria->add(Filter::like('name', 'valentina%'));

        $criteria->order_by('id');
        $criteria->order_by('name', -1);
        $criteria->limit(10);
        $criteria->offset(0);

        $statement = new Select;
        $statement->set_entity('gen_z_names');
        $statement->add_column('id');
        $statement->add_column('name');
        $statement->add_column('gender');

        $statement->set_expression($criteria);

        $this->assertEquals($result, $statement->dump());
    }
}
