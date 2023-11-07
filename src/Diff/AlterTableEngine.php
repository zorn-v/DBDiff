<?php

namespace DBDiff\Diff;

class AlterTableEngine
{
    public $table;
    public $engine;
    public $prevEngine;

    public function __construct($table, $engine, $prevEngine)
    {
        $this->table  = $table;
        $this->engine = $engine;
        $this->prevEngine = $prevEngine;
    }
}
