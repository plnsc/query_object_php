<?php

namespace pnasc;

class Delete extends Statement
{
    public function get_statement()
    {
        $sql_parts = array(implode(' ', array(
            $this::CLAUSE_DELETE_FROM, $this->get_entity())));

        if ($this->criteria) {
            $sql_parts[] = implode(' ', array(
                $this::CLAUSE_WHERE, $this->criteria->dump()));
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
