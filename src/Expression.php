<?php

namespace pnasc;

abstract class Expression
{
    protected $dialect;

    public function __construct()
    {
        $this->dialect = new SQLDialect();
    }

    abstract function dump();
}
