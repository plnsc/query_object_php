<?php

namespace pnasc;

class Update extends Statement
{
    public function dump()
    {
        $sql_parts = array(implode(' ', array(
            $this::CLAUSE_UPDATE, $this->get_entity())));

        if ($this->data && $this->data[0]) {
            $set_arguments = array();

            foreach ($this->data[0] as $column => $value) {
                $set_arguments[] = implode(' ', array(
                    $column, $this::OPERATOR_SET, $value));
            }

            $sql_parts[] = implode(' ', array(
                $this::CLAUSE_SET,
                implode(
                    $this::SEPARATOR_LIST . ' ',
                    $set_arguments
                ),
            ));
        }

        if ($this->criteria) {
            $sql_parts[] = implode(' ', array(
                $this::CLAUSE_WHERE, $this->criteria->dump()));
        }

        $this->sql = implode(' ', $sql_parts);
        return $this->sql . $this::SEPARATOR_STATEMENT;
    }

    public function next_row()
    {
        throw new \Exception(sprintf('Cannot call %s from %s',
            __METHOD__, __CLASS__));
    }
}
