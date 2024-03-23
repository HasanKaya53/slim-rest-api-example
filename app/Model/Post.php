<?php

namespace Model;
use App\Controller\BaseController;
class Post extends BaseController
{

    public function getAll()
    {

        $stmt = $this->db->prepare('SELECT id,userId,title,body FROM posts');
        $stmt->execute();
        return $stmt->fetchAll();
    }


}
