<?php

namespace DBDiff\Diff;

class AlterTableChangeColumn
{
    public $table;
    public $column;
    public $diff;

    public function __construct($table, $column, $diff)
    {
        $this->table = $table;
        $this->column = $column;
        $this->diff = $diff;
    }
}
