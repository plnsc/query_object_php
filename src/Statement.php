<?php

namespace pnasc;

abstract class Statement extends Dialect
{
    protected $entity;
    protected $criteria;
    protected $columns = [];
    protected $data = [];
    protected $data_pointer = 0;
    protected $sql = '';

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

    public function add_column($column)
    {
        $this->columns[] = $column;
    }

    public function add_row($column, $value)
    {
        if (!isset($this->data[$this->data_pointer])) {
            $this->data[$this->data_pointer] = [];
        }

        if (isset($value)) {
            $this->data[$this->data_pointer][$column] = $this->sanitize_value($value, true);

            if (!in_array($column, $this->columns)) {
                $this->columns[] = $column;
            }
        }
    }

    public function next_row()
    {
        $this->data_pointer++;
    }

    abstract public function dump();
}
