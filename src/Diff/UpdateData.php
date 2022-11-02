<?php

namespace DBDiff\Diff;

class UpdateData
{
    public function __construct($table, $diff)
    {
        $this->table = $table;
        $this->diff = $diff;
    }
}
