<?php

namespace DBDiff\Diff;

class AddTable
{
    public function __construct($table, $connection)
    {
        $this->table = $table;
        $this->connection = $connection;
    }
}
