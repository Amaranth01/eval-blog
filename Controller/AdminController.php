<?php

use App\Controller\AbstractController;

class AdminController extends AbstractController
{

    public function index()
    {
        $this->render('page/admin');
    }

    public function delUser() {
        $this->render('user/delUser');
    }
}