<?php

namespace DBDiff\SQLGen\DiffToSQL;

use DBDiff\SQLGen\SQLGenInterface;

class AddTableSQL implements SQLGenInterface
{
    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    public function getUp()
    {
        $table = $this->obj->table;
        $connection = $this->obj->connection;
        $res = $connection->select("SHOW CREATE TABLE `$table`");
        $sql = $res[0]->{'Create Table'} ?? '';
        return $sql ? $sql.';' : '';
    }

    public function getDown()
    {
        $table = $this->obj->table;
        return "DROP TABLE `$table`;";
    }
}
