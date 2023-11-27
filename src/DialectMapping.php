<?php

namespace pnasc;

class DialectMapping
{
    // const OPERATOR_ADDITION = '+';
    // const OPERATOR_SUBTRACTION = '-';
    // const OPERATOR_MULTIPLICATION = '*';
    // const OPERATOR_DIVISION = '/';
    const OPERATOR_MODULO = '%';
    const OPERATOR_EQUAL = '=';
    const OPERATOR_NOT_EQUAL = '<>'; // or !=
    const OPERATOR_LESS_THAN = '<';
    const OPERATOR_GREATER_THAN = '>';
    const OPERATOR_LESS_THAN_OR_EQUAL = '<=';
    const OPERATOR_GREATER_THAN_OR_EQUAL = '>=';
    const OPERATOR_AND = 'AND';
    const OPERATOR_OR = 'OR';
    const OPERATOR_NOT = 'NOT';
    const OPERATOR_LIKE = 'LIKE';
    const OPERATOR_IN = 'IN';
    const OPERATOR_IS = 'IS';
    const OPERATOR_BETWEEN = 'BETWEEN';
    const OPERATOR_ALIAS = 'AS';
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

    const STRING_WRAPPER = array("'", "'");
    const GROUP_WRAPPER = array("(", ")");
    const IDENTIFIER_WRAPPER = array("", ""); // ``, [] or

    const SEPARATOR_LIST = ',';
}
