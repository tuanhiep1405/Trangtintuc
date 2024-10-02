<?php

namespace Assignment\Php2News\Models;

use Assignment\Php2News\Commons\Model;

class TagPosts extends Model
{
    private string $tableName = 'tagposts';


    // Lấy tất cả tag bằng id post 
    public function getAllTagByIDPost($id)
    {

        return $this->queryBuilder
        ->select('B.nameTag')
        ->from($this->tableName, 'A')
        ->innerJoin('A', 'tags', 'B', 'A.idTag = B.id')
        ->where(
            $this->queryBuilder->expr()->and(
                'A.idPost = ?',
                'B.status = 1'
            )
        )
        ->setParameter(0, $id)
        ->fetchFirstColumn();

    }
}
