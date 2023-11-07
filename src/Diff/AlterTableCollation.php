<?php

namespace DBDiff\Diff;

class AlterTableCollation
{
    public $table;
    public $collation;
    public $prevCollation;

    public function __construct($table, $collation, $prevCollation)
    {
        $this->table  = $table;
        $this->collation = $collation;
        $this->prevCollation = $prevCollation;
    }
}
