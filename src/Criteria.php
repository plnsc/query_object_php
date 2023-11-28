<?php

namespace pnasc;

class Criteria extends Expression
{
    private $expressions = array();
    private $operators = array();
    private $properties = array();

    public function add(Expression $expression, $operator = SQLDialect::OPERATOR_AND)
    {
        $this->expressions[] = $expression;
        $this->operators[] = $operator;
    }

    public function dump()
    {
        $result = '';

        if (is_array($this->expressions)) {
            foreach ($this->expressions as $i => $expression) {
                $operator = '';

                if ($i > 0) {
                    $operator = ' ' . $this->operators[$i];
                }

                $result .= implode(' ', [$operator, $expression->dump()]);
            }
        }

        return $this->dialect->wrapper('group', trim($result));
    }

    public function set_property($property, $value)
    {
        $this->properties[$property] = $value;
    }

    public function get_property($property)
    {
        return $this->properties[$property];
    }

    public function has_property($property)
    {
        return array_key_exists($property, $this->properties);
    }
}
