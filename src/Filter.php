<?php

namespace pnasc;

class Filter extends Expression
{
    private $name;
    private $operator;
    private $value;

    private function __construct($name, $operator, $value)
    {
        $this->name = $name;
        $this->operator = $operator;

        if ($this->operator === $this::OPERATOR_BETWEEN) {
            $this->value = $value;
        } else {
            $this->value = $this->sanitize_value($value);
        }
    }

    public function dump()
    {
        if ($this->operator === $this::OPERATOR_BETWEEN) {
            return implode(' ', [
                $this->name,
                $this->operator,
                $this->value[0],
                $this::OPERATOR_BETWEEN_AND,
                $this->value[1],
            ]);
        }

        return implode(' ', [$this->name, $this->operator, $this->value]);
    }

    public static function equals($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_EQUAL, $value);
    }

    public static function not_equals($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_NOT_EQUAL, $value);
    }

    public static function is($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_IS, $value);
    }

    public static function is_not($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_IS_NOT, $value);
    }

    public static function like($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_LIKE, $value);
    }
    public static function not_like($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_NOT_LIKE, $value);
    }

    public static function in($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_IN, $value);
    }

    public static function not_in($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_NOT_IN, $value);
    }

    public static function lt($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_LESS_THAN, $value);
    }

    public static function lt_equals($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_LESS_THAN_OR_EQUAL, $value);
    }

    public static function gt($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_GREATER_THAN, $value);
    }

    public static function gt_equals($name, $value): Filter
    {
        return new self($name, Dialect::OPERATOR_GREATER_THAN_OR_EQUAL, $value);
    }

    public static function between($name, $start, $end): Filter
    {
        return new self($name, Dialect::OPERATOR_BETWEEN, [$start, $end]);
    }
}
