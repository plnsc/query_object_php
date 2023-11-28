<?php

namespace pnasc;

class Filter extends Expression
{
    private $variable;
    private $operator;
    private $value;

    function __construct($variable, $operator, $value)
    {
        parent::__construct();

        $this->variable = $variable;
        $this->operator = $operator;
        $this->value = $this->dialect->sanitize_value($value);
    }

    function dump()
    {
        return implode(' ', [$this->variable, $this->operator, $this->value]);
    }
}
