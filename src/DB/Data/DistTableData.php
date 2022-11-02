<?php

namespace DBDiff\DB\Data;

use DBDiff\Diff\InsertData;
use DBDiff\Diff\UpdateData;
use DBDiff\Diff\DeleteData;
use DBDiff\Exceptions\DataException;
use DBDiff\Logger;

class DistTableData
{
    public function __construct($manager, $params = null)
    {
        $this->manager = $manager;
        $this->source = $this->manager->getDB('source');
        $this->target = $this->manager->getDB('target');
        $this->params = $params;
    }

    public function getDataDiff($table, $key)
    {
        $sourceIterator = new TableIterator($this->source, $table);
        $differ = new DistDiff($key, $sourceIterator, $this->target, $this->params);
        return $differ->getDiff($table);
    }

    public function getDiff($table, $key)
    {
        Logger::info("Now calculating data diff for table `$table`");
        $diffs = $this->getDataDiff($table, $key);
        $diffSequence = [];
        foreach ($diffs as $name => $diff) {
            if ($diff['diff'] instanceof \Diff\DiffOp\DiffOpRemove) {
                $diffSequence[] = new DeleteData($table, $diff);
            } elseif (is_array($diff['diff'])) {
                $diffSequence[] = new UpdateData($table, $diff);
            } elseif ($diff['diff'] instanceof \Diff\DiffOp\DiffOpAdd) {
                $diffSequence[] = new InsertData($table, $diff);
            }
        }

        return $diffSequence;
    }
}
