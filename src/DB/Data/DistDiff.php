<?php namespace DBDiff\DB\Data;

use DBDiff\Params\ParamsFactory;
use Diff\Differ\MapDiffer;
use Diff\DiffOp\DiffOpAdd;
use Diff\DiffOp\DiffOpRemove;
use Illuminate\Database\MySqlConnection;

class DistDiff
{
    const SIZE = 10000;

    private $key;
    private $sourceIterator;
    private $targetConnection;
    private $params;

    public function __construct($key, TableIterator $sourceIterator, MySqlConnection $targetConnection, $params = null) {
        $this->key = $key;
        $this->sourceIterator = $sourceIterator;
        $this->targetConnection = $targetConnection;
        $this->params = $params ?: ParamsFactory::get();
    }

    public function getDiff($table)
    {
        $result = [];
        $sourceKeys = [];
        while ($this->sourceIterator->hasNext()) {
            $keys = [];
            $data1 = $this->sourceIterator->next(self::SIZE);
            foreach ($data1 as $entry1) {
                $entry1 = (array)$entry1;
                $keyData = array_only($entry1, $this->key);
                $sourceKeys[implode('-', $keyData)] = true;
                foreach ($keyData as $k => $v) {
                    $keys[$k][] = $v;
                }
            }
            $qb = $this->targetConnection->table($table);
            foreach ($keys as $k => $v) {
                $qb->whereIn($k, $v);
            }
            $data2 = $qb->get();
            // Find differences
            foreach ($data1 as $k1 => $entry1) {
                $entry1 = (array)$entry1;
                foreach ($data2 as $k2 => $entry2) {
                    $entry2 = (array)$entry2;
                    if ($this->isKeyEqual($entry1, $entry2)) {
                        // unset the fields to ignore
                        if (isset($this->params->fieldsToIgnore[$table])) {
                            foreach ($this->params->fieldsToIgnore[$table] as $fieldToIgnore) {
                                unset($entry1[$fieldToIgnore]);
                                unset($entry2[$fieldToIgnore]);
                            }
                        }

                        $differ = new MapDiffer();
                        $diff = $differ->doDiff($entry2, $entry1);
                        if (!empty($diff)) {
                            $result[] = [
                                'keys' => array_only($entry1, $this->key),
                                'diff' => $diff
                            ];
                        }
                        unset($data1[$k1]);
                        unset($data2[$k2]);
                        break;
                    }
                }
            }
            // Add new missing entries
            foreach ($data1 as $entry) {
                $entry = (array)$entry;
                $result[] = [
                    'keys' => array_only($entry, $this->key),
                    'diff' => new DiffOpAdd($entry)
                ];
            }
        }
        // Remove old extra entries
        $targetIterator = new TableIterator($this->targetConnection, $table);
        while ($targetIterator->hasNext()) {
            $data = $targetIterator->next(self::SIZE);
            foreach ($data as $entry) {
                $entry = (array)$entry;
                $keyData = array_only($entry, $this->key);
                $key = implode('-', $keyData);
                if (isset($sourceKeys[$key])) {
                    unset($sourceKeys[$key]);
                } else {
                    $result[] = [
                        'keys' => array_only($entry, $this->key),
                        'diff' => new DiffOpRemove($entry)
                    ];
                }
            }
        }

        return $result;
    }

    private function isKeyEqual($entry1, $entry2) {
        foreach ($this->key as $key) {
            if ($entry1[$key] !== $entry2[$key]) return false;
        }
        return true;
    }
}
