<?php


namespace Model;

use App\Controller\BaseController;
class Comment extends BaseController
{
    public function getAll()
    {
        $stmt = $this->db->prepare('SELECT id,postId,name,email,body FROM comments');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPostComment($postID)
    {
        $stmt = $this->db->prepare('SELECT id,postId,name,email,body FROM comments WHERE postId = :post_id');
        $stmt->execute(['post_id' => $postID]);
        return $stmt->fetchAll();
    }
}