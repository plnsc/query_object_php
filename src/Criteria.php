<?php

namespace pnasc;

class Criteria extends Expression
{
    private $expressions = array();
    private $properties = array();

    public function add(Expression $expression, $operator = Dialect::OPERATOR_AND)
    {
        $this->expressions[] = [
            'expression' => $expression,
            'operator' => $operator,
        ];
    }

    public function dump()
    {
        $result = '';

        if (is_array($this->expressions)) {
            foreach ($this->expressions as $i => $e) {
                $result .= implode(' ', [
                    ' ' . ($i > 0 ? $e['operator'] : ''),
                    $e['expression']->dump(),
                ]);
            }
        }

        return $this->wrapper('group', trim($result));
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
