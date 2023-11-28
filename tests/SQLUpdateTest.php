<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;

/**
 * @covers \pnasc\SQLUpdate
 */
class SQLUpdateTest extends TestCase
{

    public function test_statement()
    {
        $result = "UPDATE users SET name = 'Lady Gaga', email = 'somemock@email' WHERE (id = '4c4d172c-51f1-4b61-b5ee-df6ab831119b')";

        $criteria = new Criteria;
        $criteria->add(Filter::equals('id', '4c4d172c-51f1-4b61-b5ee-df6ab831119b'));

        $statement = new Update;
        $statement->set_entity('users');
        $statement->set_row_data('name', 'Lady Gaga');
        $statement->set_row_data('email', 'somemock@email');
        $statement->set_criteria($criteria);

        $this->assertEquals($result, $statement->get_statement());
    }
}
