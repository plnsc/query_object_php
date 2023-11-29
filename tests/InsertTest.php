<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;

/**
 * @covers \pnasc\Insert
 */
class InsertTest extends TestCase
{

    public function test_statement_0()
    {
        $result = "INSERT INTO users (id, name, somedate, some_number)";
        $result .= " VALUES ('4c4d172c-51f1-4b61-b5ee-df6ab831119b', 'somebody\'s name', '1993-12-17', 850.55);";

        $statement = new Insert;
        $statement->set_entity('users');

        $statement->add_row('id', '4c4d172c-51f1-4b61-b5ee-df6ab831119b');
        $statement->add_row('name', 'somebody\'s name');
        $statement->add_row('somedate', '1993-12-17');
        $statement->add_row('some_number', 850.55);

        $this->assertEquals($result, $statement->dump());
    }

    public function test_statement_1()
    {
        $result = "INSERT INTO users (id, name, somedate, some_number) VALUES";
        $result .= " ('4c4d172c-51f1-4b61-b5ee-df6ab831119b', 'somebody\'s name', '1993-12-17', 850.55)";
        $result .= ", ('0698d590-d9d8-46fe-ab49-0233ed7876e4', 'someone\'s else name', '1997-02-21', 850.56);";

        $statement = new Insert;
        $statement->set_entity('users');

        $statement->add_row('id', '4c4d172c-51f1-4b61-b5ee-df6ab831119b');
        $statement->add_row('name', 'somebody\'s name');
        $statement->add_row('somedate', '1993-12-17');
        $statement->add_row('some_number', 850.55);

        $statement->next_row();

        $statement->add_row('id', '0698d590-d9d8-46fe-ab49-0233ed7876e4');
        $statement->add_row('name', 'someone\'s else name');
        $statement->add_row('somedate', '1997-02-21');
        $statement->add_row('some_number', 850.56);

        $this->assertEquals($result, $statement->dump());
    }
}
