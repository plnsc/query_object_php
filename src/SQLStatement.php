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

        $str_wrapper = DialectMapping::STRING_WRAPPER;

        if (is_string($value)) {
            $this->columns[$column] = implode('', array(
                $str_wrapper[0],
                addslashes($value),
                $str_wrapper[1]
            ));
        } else if (is_bool($value)) {
            $this->columns[$column] = $value ?
                DialectMapping::VALUE_TRUE : DialectMapping::VALUE_FALSE;
        } else if (isset($value)) {
            $this->columns[$column] = $value;
        } else {
            $this->columns[$column] = DialectMapping::VALUE_NULL;
        }
    }

    abstract function get_statement();
}
