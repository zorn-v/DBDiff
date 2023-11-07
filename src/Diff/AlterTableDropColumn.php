<?php

namespace DBDiff\Diff;

class AlterTableDropColumn
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
