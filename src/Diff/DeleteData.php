<?php

namespace DBDiff\Diff;

class DeleteData
{
    public function __construct($table, $diff)
    {
        $this->table = $table;
        $this->diff = $diff;
    }
}
