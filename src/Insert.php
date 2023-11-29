<?php

namespace pnasc;

class Insert extends Statement
{
    public function dump()
    {
        $sep = $this::SEPARATOR_LIST . ' ';
        $rows = [];

        foreach ($this->data as $row) {
            $rows[] = $this->wrapper('group',
                implode($sep, array_values($row)));
        }

        $this->sql = implode(' ', array(
            $this::CLAUSE_INSERT_INTO,
            $this->get_entity(),
            $this->wrapper('group', implode($sep, $this->columns)),
            $this::CLAUSE_VALUES,
            implode($sep, $rows),
        ));

        return $this->sql . $this::SEPARATOR_STATEMENT;
    }

    public function set_expression(Expression $criteria)
    {
        throw new \Exception(sprintf('Cannot call %s from %s',
            __METHOD__, __CLASS__));
    }
}
