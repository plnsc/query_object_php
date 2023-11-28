<?php

namespace pnasc;

class Update extends Statement
{
    public function get_statement()
    {
        $sql_parts = array(implode(' ', array(
            $this::CLAUSE_UPDATE, $this->get_entity())));

        if ($this->data) {
            $set_arguments = array();

            foreach ($this->data as $column => $value) {
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
        return $this->sql;
    }
}
