<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;

/**
 * @covers \pnasc\SQLDelete
 */
class DeleteTest extends TestCase
{

    public function test_statement()
    {
        $result = "DELETE FROM some_table WHERE (some_table_id = 3)";

        $criteria = new Criteria;
        $criteria->add(Filter::equals('some_table_id', 3));

        $statement = new Delete;
        $statement->set_entity('some_table');
        $statement->set_criteria($criteria);

        $this->assertEquals($result, $statement->get_statement());
    }
}
