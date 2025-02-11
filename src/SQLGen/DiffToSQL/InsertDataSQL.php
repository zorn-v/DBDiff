<?php

namespace DBDiff\SQLGen\DiffToSQL;

use DBDiff\SQLGen\SQLGenInterface;

class InsertDataSQL implements SQLGenInterface
{
    public $obj;

    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    public function getUp()
    {
        $table = $this->obj->table;
        $values = $this->obj->diff['diff']->getNewValue();
        $values = array_map(function ($el) {
            if (!is_null($el)) {
                return "'" . addslashes($el) . "'";
            } else {
                return 'NULL';
            }
        }, $values);
        $fields = array_map(function ($field) {
            return "`$field`";
        }, array_keys($values));
        return "INSERT INTO `$table` (".implode(',', $fields).") VALUES(".implode(',', $values).");";
    }

    public function getDown()
    {
        $table = $this->obj->table;
        $keys = $this->obj->diff['keys'];
        array_walk($keys, function (&$value, $column) {
            $value = '`'.$column."` = '".addslashes($value)."'";
        });
        $condition = implode(' AND ', $keys);
        return "DELETE FROM `$table` WHERE $condition;";
    }
}
