<?php

namespace pnasc;

class Filter extends Expression
{
    private $variable;
    private $operator;
    private $value;

    function __construct($variable, $operator, $value)
    {
        $this->variable = $variable;
        $this->operator = $operator;
        $this->value = $this->transform($value);
    }

    function transform($value)
    {
        $result = $value;

        if (is_array($value)) {
            $list = array();

            foreach ($value as $x) {
                if (is_string($x)) {
                    $list[] = sprintf("'%s'", $x);
                } else {
                    $list[] = $x;
                }
            }

            $result = sprintf('(%s)', implode(',', $list));
        } else if (is_string($value)) {
            $result = sprintf("'%s'", $value);
        } else if (is_null($value)) {
            $result = 'NULL';
        } else if (is_bool($value)) {
            $result = $value ? 'TRUE' : 'FALSE';
        }

        return $result;
    }

    function dump()
    {
        return implode(' ', [$this->variable, $this->operator, $this->value]);
    }
}
