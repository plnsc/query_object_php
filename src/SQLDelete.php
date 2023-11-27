<?php

namespace pnasc;

class SQLDelete extends SQLStatement
{
    function get_statement()
    {
        $sql_parts = [sprintf('DELETE FROM %s', $this->entity)];

        if ($this->criteria) {
            $sql_parts[] = sprintf('WHERE %s', $this->criteria->dump());
        }

        $this->sql = implode(' ', $sql_parts);

        return $this->sql;
    }
}
