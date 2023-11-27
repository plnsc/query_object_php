<?php

namespace pnasc;

class SQLSelect extends SQLStatement
{
    function add_column($column)
    {
        $this->columns[] = $column ?? array();
    }

    function get_statement()
    {
        $sql_parts = array(implode(' ', array(
            DialectMapping::CLAUSE_SELECT,
            implode(
                sprintf('%s ', DialectMapping::SEPARATOR_LIST),
                array_values($this->columns)
            ),
            DialectMapping::CLAUSE_FROM,
            $this->entity
        )));

        if ($this->criteria) {
            $sql_parts[] = implode(' ', array(
                DialectMapping::CLAUSE_WHERE,
                $this->criteria->dump()
            ));

            if ($this->criteria->has_property('order')) {
                $sql_parts[] = implode(' ', array(
                    DialectMapping::CLAUSE_ORDER_BY,
                    $this->criteria->get_property('order')
                ));
            }
            if ($this->criteria->has_property('limit')) {
                $sql_parts[] = implode(' ', array(
                    DialectMapping::CLAUSE_LIMIT,
                    $this->criteria->get_property('limit')
                ));
            }
            if ($this->criteria->has_property('offset')) {
                $sql_parts[] = implode(' ',  array(
                    DialectMapping::CLAUSE_OFFSET,
                    $this->criteria->get_property('offset')
                ));
            }
        }

        $this->sql = implode(' ', $sql_parts);

        return $this->sql;
    }
}
