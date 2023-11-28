<?php

namespace pnasc;

abstract class SQLStatement
{
    protected $entity;
    protected $criteria;
    protected $columns;
    protected $sql;

    protected $dialect;

    public function __construct()
    {
        $this->dialect = new SqlDialect();
    }

    final function set_entity($entity)
    {
        $this->entity = $entity;
    }

    final function get_entity()
    {
        return $this->entity;
    }

    function set_criteria(Criteria $criteria)
    {
        $this->criteria = $criteria;
    }

    function set_row_data($column, $value)
    {
        if (isset($value)) {
            $this->columns[$column] =
            $this->dialect->sanitize_value($value, true);
        }
    }

    abstract function get_statement();
}
