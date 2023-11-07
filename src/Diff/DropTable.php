<?php

namespace DBDiff\Diff;

class DropTable
{
    public $table;
    public $connection;


    public function __construct($table, $connection)
    {
        $this->table = $table;
        $this->connection = $connection;
    }
}
