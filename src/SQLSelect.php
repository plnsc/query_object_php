<?php

namespace pnasc;

class SQLSelect extends SQLStatement
{
    public function add_column($column)
    {
        $this->columns[] = $column ?? array();
    }

    public function get_statement()
    {
        $sql_parts = array(implode(' ', array(
            $this::CLAUSE_SELECT,
            implode($this::SEPARATOR_LIST . ' ',
                array_values($this->columns)),
            $this::CLAUSE_FROM,
            $this->get_entity(),
        )));

        if ($this->criteria) {
            $sql_parts[] = implode(' ', array(
                $this::CLAUSE_WHERE, $this->criteria->dump()));

            if ($this->criteria->has_property('order')) {
                $sql_parts[] = implode(' ', array(
                    $this::CLAUSE_ORDER_BY,
                    $this->criteria->get_property('order'),
                ));
            }
            if ($this->criteria->has_property('limit')) {
                $sql_parts[] = implode(' ', array(
                    $this::CLAUSE_LIMIT,
                    $this->criteria->get_property('limit'),
                ));
            }
            if ($this->criteria->has_property('offset')) {
                $sql_parts[] = implode(' ', array(
                    $this::CLAUSE_OFFSET,
                    $this->criteria->get_property('offset'),
                ));
            }
        }

        $this->sql = implode(' ', $sql_parts);
        return $this->sql;
    }
}
