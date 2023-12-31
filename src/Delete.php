<?php

namespace pnasc;

class Delete extends Statement
{
    public function dump()
    {
        $sql_parts = array(implode(' ', array(
            $this::CLAUSE_DELETE_FROM, $this->get_entity())));

        if ($this->expression) {
            $sql_parts[] = implode(' ', array(
                $this::CLAUSE_WHERE, $this->expression->dump()));
        }

        $this->sql = implode(' ', $sql_parts);
        return $this->sql . $this::SEPARATOR_STATEMENT;
    }

    public function add_row($column, $value)
    {
        throw new \Exception(sprintf('Cannot call %s from %s',
            __METHOD__, __CLASS__));
    }

    public function next_row()
    {
        throw new \Exception(sprintf('Cannot call %s from %s',
            __METHOD__, __CLASS__));
    }
}
