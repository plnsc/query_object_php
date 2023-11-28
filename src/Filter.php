<?php

namespace pnasc;

class Filter extends Expression
{
    private $variable;
    private $operator;
    private $value;

    public function __construct($variable, $operator, $value)
    {
        $this->variable = $variable;
        $this->operator = $operator;
        $this->value = $this->sanitize_value($value);
    }

    public function dump()
    {
        return implode(' ', [$this->variable, $this->operator, $this->value]);
    }

    public static function equals($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_EQUAL, $value);
    }

    public static function not_equals($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_NOT_EQUAL, $value);
    }

    public static function is($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_IS, $value);
    }

    public static function is_not($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_IS_NOT, $value);
    }

    public static function like($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_LIKE, $value);
    }
    public static function not_like($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_NOT_LIKE, $value);
    }

    public static function in($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_IN, $value);
    }

    public static function not_in($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_NOT_IN, $value);
    }

    public static function lt($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_LESS_THAN, $value);
    }

    public static function lt_equals($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_LESS_THAN_OR_EQUAL, $value);
    }

    public static function gt($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_GREATER_THAN, $value);
    }

    public static function gt_equals($variable, $value): Filter
    {
        return new self($variable, Dialect::OPERATOR_GREATER_THAN_OR_EQUAL, $value);
    }
}
