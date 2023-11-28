<?php

namespace pnasc;

class SQLInsert extends SQLStatement
{
    public function get_statement()
    {
        $this->sql = implode(' ', array(
            $this->dialect::CLAUSE_INSERT_INTO,
            $this->entity,
            $this->dialect->wrapper('group',
                implode($this->dialect::SEPARATOR_LIST . ' ',
                    array_keys($this->columns))),
            $this->dialect::CLAUSE_VALUES,
            $this->dialect->wrapper('group',
                implode($this->dialect::SEPARATOR_LIST . ' ',
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
