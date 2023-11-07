<?php

namespace DBDiff\Diff;

class AddTable
{
    public $table;
    public $connection;

    public function __construct($table, $connection)
    {
        $this->table = $table;
        $this->connection = $connection;
    }
}
