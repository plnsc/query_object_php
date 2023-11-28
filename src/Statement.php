<?php

namespace pnasc;

abstract class Statement extends Dialect
{
    protected $entity;
    protected $criteria;
    protected $columns;
    protected $data;
    protected $sql;

    final public function set_entity($entity)
    {
        $this->entity = $entity;
    }

    final protected function get_entity()
    {
        return $this->wrapper('identifier', $this->entity);
    }

    public function set_criteria(Criteria $criteria)
    {
        $this->criteria = $criteria;
    }

    public function set_data($column, $value)
    {
        if (isset($value)) {
            $this->data[$column] = $this->sanitize_value($value, true);
            $this->columns[] = $column;
        }
    }

    abstract public function get_statement();
}
