<?php

namespace Assignment\Php2News\Models;

use Assignment\Php2News\Commons\Helper;
use Assignment\Php2News\Commons\Model;

class Posts extends Model
{

    private string $tableName = 'posts';

    // Lấy top ... tin tức theo ngày mới nhất và kiểu ...
    // Mặc định là top 1, kiểu 1 (Normal)
    public function getTopByType($top = 1, $type = 1)
    {
        $queryBulder = clone($this->queryBuilder);

        return $queryBulder
        ->select('A.id, A.title, A.image, A.date, B.id as idCategory, B.nameCategory, C.name as nameAuthor')
        ->from($this->tableName, 'A')
        ->innerJoin('A', 'categories', 'B', 'A.idCategory = B.id')
        ->innerJoin('A', 'users', 'C', 'A.idAuthor = C.id')
        ->innerJoin('A', 'type', 'D', 'A.idType = D.id')
        ->where(
            $queryBulder->expr()->and(
                'D.id = ?',
                'A.status = 1',
                'B.status = 1'
            )
        )
        ->setParameter(0, $type)
        ->orderBy('A.date', 'DESC')
        ->setMaxResults($top)
        ->fetchAllAssociative();

    }

    // Lấy tất cả tin tức theo ngày hiện tại
    public function getAllCurrentDate()
    {
        $queryBulder = clone($this->queryBuilder);

        $currentDate = date("Y-m-d") . '%';

        return $queryBulder
        ->select('A.id, A.title, A.description, A.image, A.date, B.nameCategory, C.name as nameAuthor')
        ->from($this->tableName, 'A')
        ->innerJoin('A', 'categories', 'B', 'A.idCategory = B.id')
        ->innerJoin('A', 'users', 'C', 'A.idAuthor = C.id')
        ->where(
            $queryBulder->expr()->and(
                $queryBulder->expr()->like('A.date', '?'),
                'A.status = 1',
                'B.status = 1'
            )
        )
        ->setParameter(0, $currentDate)
        ->orderBy('A.date', 'DESC')
        ->fetchAllAssociative();
    }

    // Lấy top ... tin tức nhiều view nhất trong ... ngày gần nhất
    public function getTopNewPopuler($top = 3)
    {
        $queryBulder = clone($this->queryBuilder);

        return $queryBulder
        ->select('A.id, A.title, A.image, A.date, A.views, B.id as idCategory, B.nameCategory, C.name as nameAuthor')
        ->from($this->tableName, 'A')
        ->innerJoin('A', 'categories', 'B', 'A.idCategory = B.id')
        ->innerJoin('A', 'users', 'C', 'A.idAuthor = C.id')
        ->where(
            $queryBulder->expr()->and(
                'A.date >= DATE_ADD(CURDATE(), INTERVAL - 3 DAY)',
                'A.status = 1',
                'B.status = 1'
            )
        )
        ->orderBy('A.views', 'DESC')
        ->setMaxResults($top)
        ->fetchAllAssociative(); 
    }

    // Lấy tất cả tin tức theo ID DANH MỤC
    public function getAllByIDCategory($id)
    {
        $queryBulder = clone($this->queryBuilder);
        
        return $queryBulder
        ->select(
            'A.id', 'A.title', 'A.description', 'A.image', 'A.date',
            'B.id AS idCategory', 'B.nameCategory',
            'C.name AS nameAuthor',
            '
                (
                    SELECT
                        SUM(totalReplyComment) + COUNT(comments.id)
                    FROM
                    ( 
                        SELECT
                            B.id,
                            ( SELECT COUNT(*) FROM replycomment A WHERE A.idComment = B.id ) AS totalReplyComment
                        FROM comments B
                        WHERE idPost = A.id
                    ) AS comments
                ) AS sumCommentInPost
            '
        )
        ->from($this->tableName, 'A')
        ->innerJoin('A', 'categories', 'B', 'A.idCategory = B.id')
        ->innerJoin('A', 'users', 'C', 'A.idAuthor = C.id')
        ->where(
            $queryBulder->expr()->and(
                'B.id = ?',
                'A.status = 1',
                'B.status = 1'
            )
        )
        ->setParameter(0, $id)
        ->orderBy('A.date', 'DESC')
        ->fetchAllAssociative();
    }

    public function getAllByIDCategoryPaginate($id, $page, $perPage)
    {
        $queryBulder = clone($this->queryBuilder);

        $offset = $perPage * ($page - 1);
        
        $postsInCategory = $queryBulder
        ->select(
            'A.id', 'A.title', 'A.description', 'A.image', 'A.date',
            'B.id AS idCategory', 'B.nameCategory',
            'C.name AS nameAuthor',
            '
                (
                    SELECT
                        SUM(totalReplyComment) + COUNT(comments.id)
                    FROM
                    ( 
                        SELECT
                            B.id,
                            ( SELECT COUNT(*) FROM replycomment A WHERE A.idComment = B.id ) AS totalReplyComment
                        FROM comments B
                        WHERE idPost = A.id
                    ) AS comments
                ) AS sumCommentInPost
            '
        )
        ->from($this->tableName, 'A')
        ->innerJoin('A', 'categories', 'B', 'A.idCategory = B.id')
        ->innerJoin('A', 'users', 'C', 'A.idAuthor = C.id')
        ->where(
            $queryBulder->expr()->and(
                'B.id = ?',
                'A.status = 1',
                'B.status = 1'
            )
        )
        ->setParameter(0, $id)
        ->orderBy('A.date', 'DESC');

        $totalPagePosts = ceil(count($postsInCategory->fetchAllAssociative()) / $perPage);

        $postsInCategory = $postsInCategory
        ->setFirstResult($offset)
        ->setMaxResults($perPage)
        ->fetchAllAssociative();

        return [$postsInCategory, $totalPagePosts];
    }

    // Lấy tin tức theo ID
    public function getByID($id)
    {
        $queryBulder = clone($this->queryBuilder);

        return $queryBulder
        ->select('A.*', 'B.id AS idCategory', 'B.nameCategory', 'C.name AS nameAuthor')
        ->from($this->tableName, 'A')
        ->innerJoin('A', 'categories', 'B', 'A.idCategory = B.id')
        ->innerJoin('A', 'users', 'C', 'A.idAuthor = C.id')
        ->where(
            $queryBulder->expr()->and(
                'A.id = ?',
                'A.status = 1'
            )
        )
        ->setParameter(0, $id)
        ->fetchAssociative();
    }

    /**
     * ////////////////////////////////////////////////////////////////////////////
     * ////////////////////////////////////////////////////////////////////////////
     */

     public function postHotSum(){
        return $this->queryBuilder
        ->select('COUNT(DISTINCT id) AS numberPostHot')
        ->from('posts')
        ->where('idType = 2')
        ->fetchOne();
    }

    public function postSum(){
        return $this->queryBuilder
        ->select('COUNT(DISTINCT id) AS numberPost')
        ->from('posts')
        ->fetchOne();
    }

    // get all
    public function getAll(int $status, $colums = ['*'])
    {
        return $this->queryBuilder
            ->select(...$colums)
            ->from($this->tableName, 'p')
            ->join('p', 'users', 'u', 'p.idAuthor = u.id')
            ->join('p', 'categories', 'c', 'p.idCategory = c.id')
            ->join('p', 'type', 't', 'p.idType = t.id')
            ->where("p.status = ? ")
            ->setParameter(0, $status)
            ->orderBy("p.dateChange", "DESC")
            ->fetchAllAssociative();
    }

    // get all
    public function getAllByPaginate(int $status, $colums, $page, $perPage, $idCategory = NULL, $search = NULL)
    {

        $queryBuilder = clone($this->queryBuilder);

        $offset = $perPage * ($page - 1);
        
        $posts = $queryBuilder
            ->select(...$colums)
            ->from($this->tableName, 'p')
            ->join('p', 'users', 'u', 'p.idAuthor = u.id')
            ->join('p', 'categories', 'c', 'p.idCategory = c.id')
            ->join('p', 'type', 't', 'p.idType = t.id');


        if($idCategory) {
            if($search) {
                $posts = $posts
                ->where(
                    "p.status = ? AND
                    c.id = ? AND
                    (p.title LIKE ? || p.title LIKE ? || p.title LIKE ?
                    || c.nameCategory LIKE ? || c.nameCategory LIKE ? || c.nameCategory LIKE ? )"
                )
                ->setParameter(0, $status)
                ->setParameter(1, $idCategory)
                ->setParameter(2, '%'.$search)
                ->setParameter(3, $search.'%')
                ->setParameter(4, '%'.$search.'%')
                ->setParameter(5, '%'.$search)
                ->setParameter(6, $search.'%')
                ->setParameter(7, '%'.$search.'%');
            }
            else {
                $posts = $posts
                ->where("p.status = ? AND c.id = ?")
                ->setParameter(0, $status)
                ->setParameter(1, $idCategory);
            }
        }
        else {
            if($search) {
                $posts = $posts
                ->where(
                    "p.status = ? AND
                    (p.title LIKE ? || p.title LIKE ? || p.title LIKE ?
                    || c.nameCategory LIKE ? || c.nameCategory LIKE ? || c.nameCategory LIKE ? )"
                )
                ->setParameter(0, $status)
                ->setParameter(1, '%'.$search)
                ->setParameter(2, $search.'%')
                ->setParameter(3, '%'.$search.'%')
                ->setParameter(4, '%'.$search)
                ->setParameter(5, $search.'%')
                ->setParameter(6, '%'.$search.'%');
            }
            else {
                $posts = $posts
                ->where("p.status = ? ")
                ->setParameter(0, $status);
            }
        }

        $totalPage = ceil(count($posts->fetchAllAssociative()) / $perPage);
            
        $posts = $posts
            ->orderBy("p.dateChange", "DESC")
            ->setFirstResult($offset)
            ->setMaxResults($perPage)
            ->fetchAllAssociative();

        return [$posts, $totalPage];
    }

    // get detail post by id
    public function getByIDDetail(int $id, string ...$colums)
    {
        return $this->queryBuilder
            ->select(...$colums)
            ->from($this->tableName, 'p')
            ->join('p', 'users', 'u', 'p.idAuthor = u.id')
            ->join('p', 'categories', 'c', 'p.idCategory = c.id')
            ->join('p', 'type', 't', 'p.idType = t.id')
            ->where("p.status = 1 AND p.id=$id")
            ->fetchAssociative();
    }

    // add 
    public function addPost($data = [])
    {
        return $this->connect->insert($this->tableName, $data);
    }

    //update post
    public function update(int $id, $data = [])
    {
        return $this->connect->update($this->tableName, $data, ['id' => $id]);
    }
   
    // delete post
    public function deletePost(int $id)
    {
        return $this->connect->delete($this->tableName, ["id" => $id]);
    }

}
