<?php

namespace pnasc;

abstract class SQLStatement
{
    protected $entity;
    protected $criteria;
    protected $columns;
    protected $sql;

    final function set_entity($entity)
    {
        $this->entity = $entity;
    }

    final function get_entity($entity)
    {
        return $this->entity;
    }

    function set_criteria(Criteria $criteria)
    {
        $this->criteria = $criteria;
    }

    function set_row_data($column, $value)
    {
        if (is_string($value)) {
            $this->columns[$column] = sprintf("'%s'", addslashes($value));
        } else if (is_bool($value)) {
            $this->columns[$column] = $value ? 'TRUE' : 'FALSE';
        } else if (isset($value)) {
            $this->columns[$column] = $value;
        } else {
            $this->columns[$column] = 'NULL';
        }
    }

    abstract function get_statement();
}
