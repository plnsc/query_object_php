<?php

namespace pnasc;

abstract class Expression extends SQLDialect
{
    abstract public function dump();
}
