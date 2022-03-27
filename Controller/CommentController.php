<?php

use App\Controller\AbstractController;

class CommentController extends AbstractController
{

    public function index()
    {
        $this->render('comment/add-comment');
    }
}