<?php

namespace DBDiff\Diff;

class SetDBCollation
{
    public function __construct($db, $collation, $prevCollation)
    {
        $this->db = $db;
        $this->collation = $collation;
        $this->prevCollation = $prevCollation;
    }
}
