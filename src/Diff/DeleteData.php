<?php

namespace DBDiff\Diff;

class DeleteData
{
    public $table;
    public $diff;

    public function __construct($table, $diff)
    {
        $this->table = $table;
        $this->diff = $diff;
    }
}
