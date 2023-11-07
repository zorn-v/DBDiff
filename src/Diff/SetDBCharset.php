<?php

namespace DBDiff\Diff;

class SetDBCharset
{
    public $db;
    public $charset;
    public $prevCharset;

    public function __construct($db, $charset, $prevCharset)
    {
        $this->db = $db;
        $this->charset = $charset;
        $this->prevCharset = $prevCharset;
    }
}
