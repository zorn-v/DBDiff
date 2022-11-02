<?php

namespace DBDiff\Diff;

class AlterTableAddConstraint
{
    public function __construct($table, $name, $diff)
    {
        $this->table = $table;
        $this->name = $name;
        $this->diff = $diff;
    }
}
