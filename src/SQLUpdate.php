<?php

namespace pnasc;

class SQLUpdate extends SQLStatement
{
    function get_statement()
    {
        $sql_parts = [sprintf('UPDATE %s', $this->entity)];

        if ($this->columns) {
            $set_arguments = [];

            foreach ($this->columns as $column => $value) {
                $set_arguments[] = sprintf('%s = %s', $column, $value);
            }

            $sql_parts[] = sprintf('SET %s', implode(', ', $set_arguments));
        }

        if ($this->criteria) {
            $sql_parts[] = sprintf('WHERE %s', $this->criteria->dump());
        }

        $this->sql = implode(' ', $sql_parts);

        return $this->sql;
    }
}
