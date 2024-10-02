<?php

namespace Assignment\Php2News\Models;

use Assignment\Php2News\Commons\Model;

class Categories extends Model
{
    private string $tableName = 'categories';

    public function getAll()
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where("status = 1")
            ->fetchAllAssociative();
    }
    
    // Lấy ra tất cả tổng các bài post trong 1 category
    public function getTotalPostInCategory()
    {
        return $this->queryBuilder
        ->select(
            'B.id,
            nameCategory,
            (SELECT COUNT(*) FROM posts A WHERE A.idCategory = B.id AND A.status = 1) AS totalPost'
        )
        ->from($this->tableName, 'B')
        ->fetchAllAssociative();
    }

    public function getByID($id, $columnsName = ['*'])
    {
        return $this->queryBuilder
            ->select(...$columnsName)
            ->from($this->tableName)
            ->where('id = ?')
            ->setParameter(0, $id)
            ->fetchAssociative();
    }

    public function getByStatus($status)
    {

        // điều kiện truy vấn trong WHERE


        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('status = ?')
            ->setParameter(0, $status)
            ->fetchAllAssociative();
    }

    // Lay tat ca va lay tong post trong 1 danh muc
    public function getAllAndTotalPost()
    {
        $queryBuilder = clone($this->queryBuilder);

        $sql = 'SELECT A.nameCategory, (SELECT COUNT(*) FROM posts B WHERE B.idCategory = A.id) AS totalPost FROM categories A WHERE status = 1';
        
        $stmt = $this->connect->prepare($sql);

        return $stmt->executeQuery()->fetchAllAssociative();

    }

    public function get7DayLastestByView()
    {
        $data = [];
        for($i = 0; $i < 7; $i++) {
            $sql = "
                SELECT A.nameCategory,
                            (SELECT COUNT(*)
                            FROM
                                    (SELECT A.id, A.nameCategory, B.views, B.date
                                    FROM categories A
                                    JOIN posts B ON A.id = B.idCategory
                                    WHERE A.status = 1 AND B.status = 1 AND B.date LIKE CONCAT(DATE_SUB(CURDATE(), INTERVAL :day DAY), '%'))
                            AS TotalViewInPost
                            WHERE TotalViewInPost.id = A.id)
                        AS totalPost,
                        DATE_SUB(CURDATE(), INTERVAL :day DAY) AS date
                FROM categories A";
            
            $stmt = $this->connect->prepare($sql);

            $stmt->bindValue('day', $i);

            $data[] = $stmt->executeQuery()->fetchAllAssociative();
        }

        return $data;
    }

    public function get1MonthLastestByView()
    {
        $data = [];

        for($i = 0; $i < 28; $i += 6) {
            $sql = "
                SELECT A.nameCategory,
                        (SELECT COUNT(*)
                        FROM
                                (SELECT A.id, A.nameCategory, B.views, B.date
                                FROM categories A
                                JOIN posts B ON A.id = B.idCategory
                                WHERE A.status = 1 AND B.status = 1 AND B.date <= DATE_SUB(CURDATE(), INTERVAL :to DAY)
                                        AND B.date >= DATE_SUB(CURDATE(), INTERVAL :from DAY))
                        AS TotalViewInPost
                        WHERE TotalViewInPost.id = A.id)
                    AS totalPost,
                    CONCAT(DATE_SUB(CURDATE(), INTERVAL :from DAY), ' - ', DATE_SUB(CURDATE(), INTERVAL :to DAY)) AS date
                FROM categories A";
            
            $stmt = $this->connect->prepare($sql);

            $stmt->bindValue('from', $i + 6);
            $stmt->bindValue('to', $i);

            $data[] = $stmt->executeQuery()->fetchAllAssociative();

            $i++;
        }

        return $data;
    }

    public function get6MonthLastestByView()
    {
        $data = [];

        for($i = 0; $i < 180; $i += 29) {
            $sql = "
                SELECT A.nameCategory,
                        (SELECT COUNT(*)
                        FROM
                                (SELECT A.id, A.nameCategory, B.views, B.date
                                FROM categories A
                                JOIN posts B ON A.id = B.idCategory
                                WHERE A.status = 1 AND B.status = 1 AND B.date <= DATE_SUB(CURDATE(), INTERVAL :to DAY)
                                        AND B.date >= DATE_SUB(CURDATE(), INTERVAL :from DAY))
                        AS TotalViewInPost
                        WHERE TotalViewInPost.id = A.id)
                    AS totalPost,
                    CONCAT(DATE_SUB(CURDATE(), INTERVAL :from DAY), ' - ', DATE_SUB(CURDATE(), INTERVAL :to DAY)) AS date
                FROM categories A";
            
            $stmt = $this->connect->prepare($sql);

            $stmt->bindValue('from', $i + 29);
            $stmt->bindValue('to', $i);

            $data[] = $stmt->executeQuery()->fetchAllAssociative();

            $i++;
        }

        return $data;
    }

    

    public function add($name)
    {
        return $this->queryBuilder
            ->insert($this->tableName)
            ->setValue('nameCategory', '?')
            ->setValue('status', 1)
            ->setParameter(0, $name)
            ->executeQuery();
    }

    public function updateStatus($id, $data = [])
    {
        return $this->connect->update(
            $this->tableName,
            $data,
            ['id' => $id]
        );
    }

    public function updateName($id, $data = [])
    {
        return $this->connect->update(
            $this->tableName,
            $data,
            ['id' => $id]
        );
    }

    public function delete($categoriesId)
    {
        return $this->queryBuilder
            ->delete($this->tableName)
            ->where('id = ?')
            ->setParameter(0, $categoriesId)
            ->executeQuery();
    }
    public function categoryNumber(){
        return $this->queryBuilder
        ->select('COUNT(DISTINCT id) AS numbercategories')
       ->from('categories')
       ->fetchOne();
       
     } 
}
