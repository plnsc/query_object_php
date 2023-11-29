<?php

namespace pnasc;

class Select extends Statement
{
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
        return $this->sql . $this::SEPARATOR_STATEMENT;
    }

    public function add_row($column, $value)
    {
        throw new \Exception(sprintf('Cannot call %s from %s',
            __METHOD__, __CLASS__));
    }
}
