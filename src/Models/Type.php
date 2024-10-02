<?php

namespace Assignment\Php2News\Models;

use Assignment\Php2News\Commons\Model;

class Type extends Model
{
    private string $tableName = 'type';

    public function getAll(string ...$colums)
    {
        return $this->queryBuilder
            ->select(...$colums)
            ->from($this->tableName)
            ->fetchAllAssociative();
    }
}
