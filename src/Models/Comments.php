<?php

namespace Assignment\Php2News\Models;

use Assignment\Php2News\Commons\Model;

class Comments extends Model
{
    private string $tableName = 'comments';


    // Lấy tất cả comments bằng id post
    public function getAllByIdPost($id)
    {
        $queryBuilder = clone ($this->queryBuilder);

        return $queryBuilder
            ->select('cm.*', 'us.name', 'us.avatar')
            ->from($this->tableName, 'cm')
            ->Join('cm', 'users', 'us', 'cm.idUser = us.id')
            ->Join('cm', 'posts', 'ps', 'cm.idPost = ps.id')
            ->where('ps.id = ?')
            ->setParameter(0, $id)
            ->fetchAllAssociative();
    }
    public function getByID($id)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('id = :id')
            ->setParameter('id', $id)
            ->fetchAllAssociative();
    }
    public function getCommentsByIDPost($idPost)
    {
        return $this->queryBuilder
            ->select(
                'B.id', 'B.content', 'B.date',
                'C.name', 'C.avatar',
                '(SELECT COUNT(*) AS totalReply FROM replycomment A WHERE A.idComment = B.id) AS totalReply'
            )
            ->from($this->tableName, 'B')
            ->innerJoin('B', 'posts', 'P', 'B.idPost = P.id')
            ->innerJoin('B', 'users', 'C', 'B.idUser = C.id')
            ->where('P.id = ?')
            ->setParameter(0, $idPost)
            ->fetchAllAssociative();
    }

    public function getAllCommentByIDPost($id)
    {

        $sql = "
            SELECT SUM(totalReplyComment) + COUNT(comments.id) AS totalComment FROM
            ( 
                SELECT
                    B.id,
                    ( SELECT COUNT(*) FROM replycomment A WHERE A.idComment = B.id ) AS totalReplyComment
                FROM comments B
                WHERE idPost = ?
            ) AS comments
        ";

        $stmt = $this->connect->prepare($sql);

        $stmt->bindValue(1, $id);

        return $stmt->executeQuery()->fetchOne();
    }
    public function Commentsum()
    {
        return $this->queryBuilder
            ->select('
            (SELECT COUNT(*) FROM comments) + 
            (SELECT COUNT(*) FROM replycomment) AS SoLuong
        ')
            ->fetchOne();
    }
    public function postHot()
    {
        return $this->queryBuilder
            ->select('COUNT(DISTINCT id) AS numberPostHot')
            ->from('posts')
            ->where('idType = 2')
            ->fetchAssociative();
    }

    public function postSum()
    {
        return $this->queryBuilder
            ->select('COUNT(DISTINCT id) AS numberPost')
            ->from('posts')
            ->fetchAssociative();
    }

    public function deleteByID($id)
    {
        return $this->queryBuilder
            ->delete($this->tableName)
            ->where('id = ?')
            ->setParameter(0, $id)
            ->executeQuery();
    }

    public function addComment($data = [])
    {
        return $this->connect->insert($this->tableName, $data);
    }

    
}
