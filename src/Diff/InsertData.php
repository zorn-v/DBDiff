<?php

namespace DBDiff\Diff;

class InsertData
{
    public function __construct($table, $diff)
    {
        $this->table = $table;
        $this->diff = $diff;
    }
}
