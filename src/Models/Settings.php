<?php

namespace Assignment\Php2News\Models;

use Assignment\Php2News\Commons\Model;

class Settings extends Model
{
    private string $tableName = 'setting';

    public function get()
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->fetchAssociative();
    }
    public function update( $data = [])
    {
        return $this->connect->update($this->tableName, $data);
    }
}
