<?php

namespace pnasc;

class SQLInsert extends SQLStatement
{
    public function get_statement()
    {
        $this->sql = implode(' ', array(
            $this::CLAUSE_INSERT_INTO,
            $this->get_entity(),
            $this->wrapper('group',
                implode($this::SEPARATOR_LIST . ' ',
                    array_keys($this->columns))),
            $this::CLAUSE_VALUES,
            $this->wrapper('group',
                implode($this::SEPARATOR_LIST . ' ',
                    array_values($this->columns))),
        ));

        return $this->sql;
    }

    public function set_criteria(Criteria $criteria)
    {
        throw new \Exception(sprintf('Cannot call %s from %s',
            __METHOD__, __CLASS__));
    }
}
