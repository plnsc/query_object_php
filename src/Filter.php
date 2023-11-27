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
        $str_wrapper = DialectMapping::STRING_WRAPPER;
        $group_wrapper = DialectMapping::GROUP_WRAPPER;

        $result = $value;

        if (is_array($value)) {
            $list = array();

            foreach ($value as $x) {
                if (is_string($x)) {
                    $list[] = implode('', array($str_wrapper[0], $x, $str_wrapper[1]));
                } else {
                    $list[] = $x;
                }
            }

            $result = implode('', array(
                $group_wrapper[0],
                implode(DialectMapping::SEPARATOR_LIST, $list),
                $group_wrapper[1]
            ));
        } else if (is_string($value)) {
            $result = implode('', array($str_wrapper[0], $value, $str_wrapper[1]));
        } else if (is_null($value)) {
            $result = DialectMapping::VALUE_NULL;
        } else if (is_bool($value)) {
            $result = $value ? DialectMapping::VALUE_TRUE : DialectMapping::VALUE_FALSE;
        }

        return $result;
    }

    function dump()
    {
        return implode(' ', [$this->variable, $this->operator, $this->value]);
    }
}
