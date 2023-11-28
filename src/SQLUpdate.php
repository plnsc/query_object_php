<?php

namespace pnasc;

class SQLUpdate extends SQLStatement
{
    public function get_statement()
    {
        $sql_parts = array(implode(' ', array(
            $this->dialect::CLAUSE_UPDATE, $this->get_entity())));

        if ($this->columns) {
            $set_arguments = array();

            foreach ($this->columns as $column => $value) {
                $set_arguments[] = implode(' ', array(
                    $column, $this->dialect::OPERATOR_SET, $value));
            }

            $sql_parts[] = implode(' ', array(
                $this->dialect::CLAUSE_SET,
                implode(
                    $this->dialect::SEPARATOR_LIST . ' ',
                    $set_arguments
                ),
            ));
        }

        if ($this->criteria) {
            $sql_parts[] = implode(' ', array(
                $this->dialect::CLAUSE_WHERE, $this->criteria->dump()));
        }

        $this->sql = implode(' ', $sql_parts);
        return $this->sql;
    }
}
