<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;

/**
 * @covers \pnasc\Insert
 */
class SQLInsertTest extends TestCase
{

    public function test_statement()
    {
        $result  = "INSERT INTO aluno (id, fone, nascimento, genero, serie, mensalidade)";
        $result .= " VALUES ('Paulo Nascimento', '+55 81 99631-1490', '1993-12-17', 'hc', 'si', 850.55)";

        $statement = new SQLInsert;
        $statement->set_entity('aluno');
        $statement->set_row_data('id', 7);
        $statement->set_row_data('id', 'Paulo Nascimento');
        $statement->set_row_data('fone', '+55 81 99631-1490');
        $statement->set_row_data('nascimento', '1993-12-17');
        $statement->set_row_data('genero', 'hc');
        $statement->set_row_data('serie', 'si');
        $statement->set_row_data('mensalidade', 850.55);

        $this->assertEquals($result, $statement->get_statement());
    }
}
