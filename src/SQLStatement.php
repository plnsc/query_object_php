<?php

namespace pnasc;

abstract class SQLStatement extends SQLDialect
{
    protected $entity;
    protected $criteria;
    protected $columns;
    protected $sql;

    final public function set_entity($entity)
    {
        $this->entity = $entity;
    }

    final public function get_entity()
    {
        return $this->wrapper('identifier', $this->entity);
    }

    public function set_criteria(Criteria $criteria)
    {
        $this->criteria = $criteria;
    }

    public function set_row_data($column, $value)
    {
        if (isset($value)) {
            $this->columns[$column] =
            $this->sanitize_value($value, true);
        }
    }

    abstract public function get_statement();
}
