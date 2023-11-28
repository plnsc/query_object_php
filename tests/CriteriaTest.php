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
        $criteria->add(Filter::in('br_state', ['PE', 'RN', 'PB']));
        $criteria->add(Filter::not_in('br_state', ['SP', 'RJ']));

        $this->assertEquals($result, $criteria->dump());
    }

    public function test_string()
    {
        $result = "(nome LIKE 'enzo%' AND nome LIKE 'valentina%')";

        $criteria = new Criteria;
        $criteria->add(Filter::like('nome', 'enzo%'));
        $criteria->add(Filter::like('nome', 'valentina%'));

        $this->assertEquals($result, $criteria->dump());
    }

    public function test_integer()
    {
        $result = "(idade < 16 OR idade > 60)";

        $criteria = new Criteria;
        $criteria->add(Filter::lt('idade', 16), SQLDialect::OPERATOR_OR);
        $criteria->add(Filter::gt('idade', 60), SQLDialect::OPERATOR_OR);

        $this->assertEquals($result, $criteria->dump());
    }

    public function test_null()
    {
        $result = "(telefone IS NOT NULL AND genero = 'nb')";

        $criteria = new Criteria;
        $criteria->add(Filter::is_not('telefone', null));
        $criteria->add(Filter::equals('genero', 'nb'));

        $this->assertEquals($result, $criteria->dump());
    }

    public function test_bool()
    {
        $result = "(status = FALSE AND some_number = 1024)";

        $criteria = new Criteria;
        $criteria->add(Filter::equals('status', false));
        $criteria->add(Filter::equals('some_number', 1024));

        $this->assertEquals($result, $criteria->dump());
    }

    public function test_nested()
    {
        $result = "((field = 'some_value' AND some_number < 24) OR (field = 'another_value' AND some_number > 16))";

        $criteria_1 = new Criteria;
        $criteria_1->add(Filter::equals('field', 'some_value'));
        $criteria_1->add(Filter::lt('some_number', 24));

        $criteria_2 = new Criteria;
        $criteria_2->add(Filter::equals('field', 'another_value'));
        $criteria_2->add(Filter::gt('some_number', 16));

        $criteria_3 = new Criteria;
        $criteria_3->add($criteria_1);
        $criteria_3->add($criteria_2, SQLDialect::OPERATOR_OR);

        $this->assertEquals($result, $criteria_3->dump());
    }
}
