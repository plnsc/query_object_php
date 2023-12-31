<?php

namespace pnasc;

class Select extends Statement
{
    public function dump()
    {
        $sql_parts = array(implode(' ', array(
            $this::CLAUSE_SELECT,
            implode($this::SEPARATOR_LIST . ' ',
                array_values($this->columns)),
            $this::CLAUSE_FROM,
            $this->get_entity(),
        )));

        if ($this->expression) {
            $sql_parts[] = implode(' ', array(
                $this::CLAUSE_WHERE, $this->expression->dump()));

            if ($this->expression->has_property('order_by')) {
                $order_by = $this->expression->get_property('order_by');

                foreach ($order_by as $i => $column) {
                    $order_by[$i] = implode(' ', [
                        $this->wrapper('identifier', $column[0]),
                        $column[1],
                    ]);
                }

                $sql_parts[] = implode(' ', array(
                    $this::CLAUSE_ORDER_BY,
                    implode($this::SEPARATOR_LIST . ' ', $order_by),
                ));
            }
            if ($this->expression->has_property('limit')) {
                $sql_parts[] = implode(' ', array(
                    $this::CLAUSE_LIMIT,
                    $this->expression->get_property('limit'),
                ));
            }
            if ($this->expression->has_property('offset')) {
                $sql_parts[] = implode(' ', array(
                    $this::CLAUSE_OFFSET,
                    $this->expression->get_property('offset'),
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
