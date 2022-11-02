<?php

namespace DBDiff\Diff;

class AlterTableEngine
{
    public function __construct($table, $engine, $prevEngine)
    {
        $this->table  = $table;
        $this->engine = $engine;
        $this->prevEngine = $prevEngine;
    }
}
