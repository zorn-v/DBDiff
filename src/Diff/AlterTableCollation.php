<?php

namespace DBDiff\Diff;

class AlterTableCollation
{
    public function __construct($table, $collation, $prevCollation)
    {
        $this->table  = $table;
        $this->collation = $collation;
        $this->prevCollation = $prevCollation;
    }
}
