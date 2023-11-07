<?php

namespace DBDiff\Diff;

class AlterTableDropConstraint
{
    public $table;
    public $name;
    public $diff;

    public function __construct($table, $name, $diff)
    {
        $this->table = $table;
        $this->name = $name;
        $this->diff = $diff;
    }
}
