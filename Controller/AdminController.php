<?php

use App\Controller\AbstractController;

class AdminController extends AbstractController
{

    public function index()
    {
//        if((new App\Model\Entity\User)->getId() !== 1 ) {
//            $errorMessage = "Seul un administrateur peut accéder à cette partie";
//            $_SESSION['errors'] [] = $errorMessage;
//            $this->render('home/index');
//        }
//        else {
            $this->render('page/admin');
//        }

    }

    public function delUser()
    {
        $this->render('user/del-user');
    }

    public function listUser()
    {
        $this->render('user/list-user');
    }

}