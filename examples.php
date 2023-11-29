<?php

namespace pnasc;

require './vendor/autoload.php';

// some_column = 'some_value'
// echo Filter::equals('some_column', 'some_value')->dump();

// some_column IS NOT NULL
// echo Filter::is_not('some_column', null)->dump();

// (some_column LIKE '%something%')
// $criteria = new Criteria;
// $criteria->add(Filter::like('some_column', '%something%'));
// echo $criteria->dump();

// (some_number IN (10,11,12,13) AND some_other_number <= 70)
// $criteria = new Criteria;
// $criteria->add(Filter::in('some_number', [10, 11, 12, 13]));
// $criteria->add(Filter::lt_equals('some_other_number', 70));
// echo $criteria->dump();

// (some_column_0 LIKE '%something%' OR (some_column_1 NOT LIKE '%something%' OR some_column_2 BETWEEN 0 AND 100))
// $criteria1 = new Criteria;
// $criteria1->add(Filter::not_like('some_column_1', '%something%'));
// $criteria1->add(Filter::between('some_column_2', 0, 100), Dialect::OPERATOR_OR);

// $criteria2 = new Criteria;
// $criteria2->add(Filter::like('some_column_0', '%something%'));
// $criteria2->add($criteria1, Dialect::OPERATOR_OR);

// echo $criteria2->dump();

// $statement = new Insert;
// $statement->set_entity('table_name');
// echo $statement->dump();

echo PHP_EOL;
