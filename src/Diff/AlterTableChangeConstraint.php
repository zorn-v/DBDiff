<?php

namespace DBDiff\Diff;

class AlterTableChangeConstraint
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
