<?php

namespace pnasc;

class SQLDelete extends SQLStatement
{
    public function get_statement()
    {
        $sql_parts = array(implode(' ', array(
            $this->dialect::CLAUSE_DELETE_FROM, $this->get_entity())));

        if ($this->criteria) {
            $sql_parts[] = implode(' ', array(
                $this->dialect::CLAUSE_WHERE, $this->criteria->dump()));
        }

        $this->sql = implode(' ', $sql_parts);
        return $this->sql;
    }
}
