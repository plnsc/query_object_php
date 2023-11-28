<?php

namespace pnasc;

use PHPUnit\Framework\TestCase;

/**
 * @covers \pnasc\Criteria
 */
class CriteriaTest extends TestCase
{
    public function test_list()
    {
        $result = "(br_state IN ('PE','RN','PB') AND br_state NOT IN ('SP','RJ'))";

        $criteria = new Criteria;
        $criteria->add(new Filter('br_state', 'IN', array('PE', 'RN', 'PB')));
        $criteria->add(new Filter('br_state', 'NOT IN', array('SP', 'RJ')));

        $this->assertEquals($result, $criteria->dump());
    }

    public function test_string()
    {
        $result = "(nome LIKE 'enzo%' AND nome LIKE 'valentina%')";

        $criteria = new Criteria;
        $criteria->add(new Filter('nome', 'LIKE', 'enzo%'));
        $criteria->add(new Filter('nome', 'LIKE', 'valentina%'));

        $this->assertEquals($result, $criteria->dump());
    }

    public function test_integer()
    {
        $result = "(idade < 16 OR idade > 60)";

        $criteria = new Criteria;
        $criteria->add(new Filter('idade', '<', 16), SQLDialect::OPERATOR_OR);
        $criteria->add(new Filter('idade', '>', 60), SQLDialect::OPERATOR_OR);

        $this->assertEquals($result, $criteria->dump());
    }

    public function test_null()
    {
        $result = "(telefone IS NOT NULL AND genero = 'nb')";

        $criteria = new Criteria;
        $criteria->add(new Filter('telefone', 'IS NOT', null));
        $criteria->add(new Filter('genero', '=', 'nb'));

        $this->assertEquals($result, $criteria->dump());
    }

    public function test_bool()
    {
        $result = "(status = FALSE AND some_number = 1024)";

        $criteria = new Criteria;
        $criteria->add(new Filter('status', '=', false));
        $criteria->add(new Filter('some_number', '=', 1024));

        $this->assertEquals($result, $criteria->dump());
    }

    public function test_nested()
    {
        $result = "((field = 'some_value' AND some_number < 24) OR (field = 'another_value' AND some_number > 16))";

        $criteria_1 = new Criteria;
        $criteria_1->add(new Filter('field', '=', 'some_value'));
        $criteria_1->add(new Filter('some_number', '<', 24));

        $criteria_2 = new Criteria;
        $criteria_2->add(new Filter('field', '=', 'another_value'));
        $criteria_2->add(new Filter('some_number', '>', 16));

        $criteria_3 = new Criteria;
        $criteria_3->add($criteria_1);
        $criteria_3->add($criteria_2, SQLDialect::OPERATOR_OR);

        $this->assertEquals($result, $criteria_3->dump());
    }
}
