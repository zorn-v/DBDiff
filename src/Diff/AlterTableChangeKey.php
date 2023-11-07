<?php

namespace DBDiff\Diff;

class AlterTableChangeKey
{
    public $table;
    public $key;
    public $diff;

    public function __construct($table, $key, $diff)
    {
        $this->table = $table;
        $this->key = $key;
        $this->diff = $diff;
    }
}
