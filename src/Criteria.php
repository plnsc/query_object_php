<?php

namespace pnasc;

class Criteria extends Expression
{
    private $expressions = array();
    private $operators = array();
    private $properties = array();

    function add(Expression $expression, $operator = self::AND_OPERATOR)
    {
        if (empty($this->expressions)) {
            unset($operator);
        }

        $this->expressions[] = $expression;
        $this->operators[] = $operator ?? '';
    }

    function dump()
    {
        $result = '';

        if (is_array($this->expressions)) {
            foreach ($this->expressions as $e => $expression) {
                $result .= sprintf('%s %s ', $this->operators[$e], $expression->dump());
            }
        }

        return sprintf('(%s)', trim($result));
    }

    function set_property($property, $value)
    {
        $this->properties[$property] = $value;
    }

    function get_property($property)
    {
        return $this->properties[$property];
    }

    function has_property($property)
    {
        return array_key_exists($property, $this->properties);
    }
}
