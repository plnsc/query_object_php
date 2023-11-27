<?php

namespace pnasc;

class SQLInsert extends SQLStatement
{
    function get_statement()
    {
        $this->sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->entity,
            implode(', ', array_keys($this->columns)),
            implode(', ', array_values($this->columns))
        );

        return $this->sql;
    }

    function set_criteria(Criteria $criteria)
    {
        throw new \Exception(sprintf('Cannot call set_criteria from %s', __CLASS__));
    }
}
