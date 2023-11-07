<?php

namespace DBDiff\Diff;

class UpdateData
{
    public $table;
    public $diff;

    public function __construct($table, $diff)
    {
        $this->table = $table;
        $this->diff = $diff;
    }
}
