<?php

namespace pnasc;

class Dialect
{
    // const OPERATOR_ADDITION = '+';
    // const OPERATOR_SUBTRACTION = '-';
    // const OPERATOR_MULTIPLICATION = '*';
    // const OPERATOR_DIVISION = '/';
    // const OPERATOR_MODULO = '%';
    const OPERATOR_EQUAL = '=';
    const OPERATOR_NOT_EQUAL = '<>'; // or !=
    const OPERATOR_IS = 'IS';
    const OPERATOR_IS_NOT = 'IS NOT';
    const OPERATOR_LIKE = 'LIKE';
    const OPERATOR_NOT_LIKE = 'NOT LIKE';
    const OPERATOR_IN = 'IN';
    const OPERATOR_NOT_IN = 'NOT IN';
    const OPERATOR_LESS_THAN = '<';
    const OPERATOR_LESS_THAN_OR_EQUAL = '<=';
    const OPERATOR_GREATER_THAN = '>';
    const OPERATOR_GREATER_THAN_OR_EQUAL = '>=';
    const OPERATOR_AND = 'AND';
    const OPERATOR_OR = 'OR';
    // const OPERATOR_BETWEEN = 'BETWEEN';
    // const OPERATOR_ALIAS = 'AS';
    const OPERATOR_SET = '=';

    const VALUE_TRUE = 'TRUE';
    const VALUE_FALSE = 'FALSE';
    const VALUE_NULL = 'NULL';

    const CLAUSE_INSERT_INTO = 'INSERT INTO';
    const CLAUSE_VALUES = 'VALUES';
    const CLAUSE_SELECT = 'SELECT';
    const CLAUSE_FROM = 'FROM';
    const CLAUSE_UPDATE = 'UPDATE';
    const CLAUSE_SET = 'SET';
    const CLAUSE_DELETE_FROM = 'DELETE FROM';
    const CLAUSE_WHERE = 'WHERE';
    const CLAUSE_GROUP_BY = 'GROUP BY';
    const CLAUSE_HAVING = 'HAVING';
    const CLAUSE_ORDER_BY = 'ORDER BY';
    const CLAUSE_SORT_ASCENDING = 'ASC';
    const CLAUSE_SORT_DESCENDING = 'DESC';
    const CLAUSE_OFFSET = 'OFFSET';
    const CLAUSE_LIMIT = 'LIMIT';

    const SEPARATOR_LIST = ',';

    private const STRING_WRAPPER = ["'", "'"];
    private const IDENTIFIER_WRAPPER = ["", ""]; // ``, [] or
    private const GROUP_WRAPPER = ["(", ")"];

    final public function wrapper($name, $content)
    {
        $pairs = [
            'string' => self::STRING_WRAPPER,
            'identifier' => self::IDENTIFIER_WRAPPER,
            'group' => self::GROUP_WRAPPER,
        ];

        if (in_array($name, array_keys($pairs))) {
            return implode("",
                [$pairs[$name][0], $content, $pairs[$name][1]]);
        }

        return $content;
    }

    final function sanitize_value($value, $ignore_list = false)
    {
        if (is_array($value) && !$ignore_list) {
            foreach ($value as $k => $v) {
                $value[$k] = self::sanitize_value($v);
            }

            return $this->wrapper('group',
                implode(self::SEPARATOR_LIST, $value));
        } else if (is_string($value)) {
            return $this->wrapper('string', addslashes($value));
        } else if (is_null($value)) {
            return self::VALUE_NULL;
        } else if (is_bool($value)) {
            return $value ? self::VALUE_TRUE : self::VALUE_FALSE;
        }

        return $value;
    }
}
