<?php

namespace pnasc;

class SQLUpdate extends SQLStatement
{
    function get_statement()
    {
        $sql_parts = array(implode(' ', array(
            DialectMapping::CLAUSE_UPDATE,
            $this->entity
        )));

        if ($this->columns) {
            $set_arguments = [];

            foreach ($this->columns as $column => $value) {
                $set_arguments[] = implode(' ', array(
                    $column,
                    DialectMapping::OPERATOR_SET,
                    $value
                ));
            }

            $sql_parts[] = implode(' ', array(
                DialectMapping::CLAUSE_SET,
                implode(
                    sprintf('%s ', DialectMapping::SEPARATOR_LIST),
                    $set_arguments
                )
            ));
        }

        if ($this->criteria) {
            $sql_parts[] = implode(' ', array(
                DialectMapping::CLAUSE_WHERE, $this->criteria->dump()
            ));
        }

        $this->sql = implode(' ', $sql_parts);

        return $this->sql;
    }
}
