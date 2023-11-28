<?php

namespace pnasc;

class Insert extends Statement
{
    public function get_statement()
    {
        $this->sql = implode(' ', array(
            $this::CLAUSE_INSERT_INTO,
            $this->get_entity(),
            $this->wrapper('group',
                implode($this::SEPARATOR_LIST . ' ',
                    array_keys($this->data))),
            $this::CLAUSE_VALUES,
            $this->wrapper('group',
                implode($this::SEPARATOR_LIST . ' ',
                    array_values($this->data))),
        ));

        return $this->sql;
    }

    public function set_criteria(Criteria $criteria)
    {
        throw new \Exception(sprintf('Cannot call %s from %s',
            __METHOD__, __CLASS__));
    }
}
