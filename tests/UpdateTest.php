<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;

/**
 * @covers \pnasc\SQLUpdate
 */
class UpdateTest extends TestCase
{

    public function test_statement()
    {
        $result = "UPDATE users SET name = 'Lady Gaga', email = 'somemock@email' WHERE (id = '4c4d172c-51f1-4b61-b5ee-df6ab831119b');";

        $criteria = new Criteria;
        $criteria->add(Filter::equals('id', '4c4d172c-51f1-4b61-b5ee-df6ab831119b'));

        $statement = new Update;
        $statement->set_entity('users');
        $statement->add_row('name', 'Lady Gaga');
        $statement->add_row('email', 'somemock@email');
        $statement->set_expression($criteria);

        $this->assertEquals($result, $statement->dump());
    }
}
