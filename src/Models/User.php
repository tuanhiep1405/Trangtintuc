<?php

namespace Assignment\Php2News\Models;

use Assignment\Php2News\Commons\Helper;
use Assignment\Php2News\Commons\Model;

class User extends Model
{
    private string $tableName = 'users';

    // Hàm getAll: Lấy tất cả bảng
    public function getAll()
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->fetchAllAssociative();
    }

    // Hàm getByStatus: Lấy theo trạng thái
    public function getByStatus(
        $status = [2],
        $columnsName = ['*'],
        $orderBy = ['id', 'DESC']
    )
    {

        // điều kiện truy vấn trong WHERE
        $condition = '';
        
        if (count($status) >= 2) {

            // các thông số trong where
            $params = [];
        
            foreach($status as $statu) {
                $params[] = $this->queryBuilder->expr()->eq('status', $statu);
            }

            $condition = $this->queryBuilder->expr()->or(
                ...$params
            );
            
        } else {
            $condition = "status = {$status[0]}";
        }

        return $this->queryBuilder
            ->select(...$columnsName)
            ->from($this->tableName)
            ->where($condition)
            ->orderBy(...$orderBy)
            ->fetchAllAssociative();

    }

    public function getByStatusPanigate(
        $status,
        $columnsName,
        $orderBy,
        $page,
        $perPage,
        $idManager = NULL
    )
    {
        $queryBuilder = clone($this->queryBuilder);

        $offset = $perPage * ($page - 1);

        // điều kiện truy vấn trong WHERE
        $condition = '';
        
        if (count($status) >= 2) {

            // các thông số trong where
            $params = [];
        
            foreach($status as $statu) {
                $params[] = $this->queryBuilder->expr()->eq('status', $statu);
            }

            $condition = $this->queryBuilder->expr()->or(
                ...$params
            );
            
        } else {
            $condition = "status = {$status[0]}";
        }

        if($idManager) {
            $condition .= "AND id <> " . $idManager;
        }

        $users = $queryBuilder
            ->select(...$columnsName)
            ->from($this->tableName)
            ->where($condition);

        $totalPage = ceil(count($users->fetchAllAssociative()) / $perPage);
        
        $users = $users
            ->orderBy(...$orderBy)
            ->setFirstResult($offset)
            ->setMaxResults($perPage)
            ->fetchAllAssociative();


        return [$users, $totalPage];
    }

    // Hàm getByID: Lấy theo ID
    public function getByID($id, $columnsName = ['*'])
    {
        return $this->queryBuilder
            ->select(...$columnsName)
            ->from($this->tableName)
            ->where('id = ?')
            ->setParameter(0, $id)
            ->fetchAssociative();
    }

    // Hàm getByEmail: Lấy theo Email
    public function getByEmail($email, $columnsName = ['*'])
    {
        return $this->queryBuilder
        ->select(...$columnsName)
        ->from($this->tableName)
        ->where('email = ?')
        ->setParameter(0, $email)
        ->fetchAssociative();
    }

    // Hàm getTotalComment: lấy tất cả comment của 1 người dùng
    public function getTotalComment($id)
    {
        $queryBuilder1 = clone($this->queryBuilder);
        $queryBuilder2 = clone($this->queryBuilder);

        $totalComment = $queryBuilder1
        ->select('COUNT(A.id) AS totalComment')
        ->from($this->tableName, 'A')
        ->innerJoin('A', 'comments', 'B', 'A.id = B.idUser')
        ->where('A.id = ?')
        ->setParameter(0, $id)
        ->fetchOne();

        $totalReplyComment = $queryBuilder2
        ->select('COUNT(A.id) AS totalReplyComment')
        ->from($this->tableName, 'A')
        ->innerJoin('A', 'replycomment', 'C', 'A.id = C.idUser')
        ->where('A.id = ?')
        ->setParameter(0, $id)
        ->fetchOne();

        return $totalComment + $totalReplyComment;
    }

    // Hàm getTotalPost: lấy tất cả post của 1 người dùng
    public function getTotalPost($id)
    {

        return $this->queryBuilder
        ->select('COUNT(A.id) AS totalPost')
        ->from($this->tableName, 'A')
        ->innerJoin('A', 'posts', 'B', 'A.id = B.idAuthor')
        ->where('A.id = ?')
        ->setParameter(0, $id)
        ->fetchOne();

    }

    // Hàm insert: Insert
    public function insert($data = [])
    {
        $this->connect->insert(
            $this->tableName,
            $data
        );

        return $this->connect->lastInsertId();
    }

    // Hàm update: Update
    public function update($id, $data = [])
    {
        return $this->connect->update(
            $this->tableName,
            $data,
            ['id' => $id]
        );
    }


}
