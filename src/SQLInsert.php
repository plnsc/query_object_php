<?php

namespace pnasc;

class SQLInsert extends SQLStatement
{
    function get_statement()
    {
        $group_wrapper = DialectMapping::GROUP_WRAPPER;

        $this->sql = implode(' ', array(
            DialectMapping::CLAUSE_INSERT_INTO,
            $this->entity,
            implode('', array(
                $group_wrapper[0],
                implode(', ', array_keys($this->columns)),
                $group_wrapper[1]
            )),
            DialectMapping::CLAUSE_VALUES,
            implode('', array(
                $group_wrapper[0],
                implode(', ', array_values($this->columns)),
                $group_wrapper[1]
            )),
        ));

        return $this->sql;
    }

    function set_criteria(Criteria $criteria)
    {
        throw new \Exception(sprintf('Cannot call set_criteria from %s', __CLASS__));
    }
}
