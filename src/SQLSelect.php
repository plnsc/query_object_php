<?php

namespace pnasc;

class SQLSelect extends SQLStatement
{
    function add_column($column)
    {
        $this->columns[] = $column;
    }

    function get_statement()
    {
        $sql_parts = [
            sprintf(
                'SELECT %s FROM %s',
                implode(', ', array_keys($this->columns ?? [])),
                $this->entity
            )
        ];

        if ($this->criteria) {
            $sql_parts[] = sprintf('WHERE %s', $this->criteria->dump());

            if ($this->criteria->has_property('order')) {
                $sql_parts[] = sprintf(
                    'ORDER BY %s',
                    $this->criteria->get_property('order')
                );
            }
            if ($this->criteria->has_property('limit')) {
                $sql_parts[] = sprintf(
                    'LIMIT %s',
                    $this->criteria->get_property('limit')
                );
            }
            if ($this->criteria->has_property('offset')) {
                $sql_parts[] = sprintf(
                    'OFFSET %s',
                    $this->criteria->get_property('offset')
                );
            }
        }

        $this->sql = implode(' ', $sql_parts);

        return $this->sql;
    }
}
