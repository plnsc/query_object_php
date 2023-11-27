<?php

namespace pnasc;

class SQLDelete extends SQLStatement
{
    function get_statement()
    {
        $sql_parts = array(implode(' ', array(
            DialectMapping::CLAUSE_DELETE_FROM,
            $this->entity
        )));

        if ($this->criteria) {
            $sql_parts[] = implode(' ', array(
                DialectMapping::CLAUSE_WHERE,
                $this->criteria->dump()
            ));
        }

        $this->sql = implode(' ', $sql_parts);

        return $this->sql;
    }
}
