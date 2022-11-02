<?php

namespace DBDiff\Diff;

class AlterTableAddColumn
{
    public function __construct($table, $column, $diff)
    {
        $this->table = $table;
        $this->column = $column;
        $this->diff = $diff;
    }
}
