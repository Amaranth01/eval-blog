<?php

use App\Controller\AbstractController;

class HomeController extends AbstractController {

    /**
     * Redirected to home page
     */
    public function index()
    {
        $this->render('home/index');
    }

    public function europeen()
    {
        $this->render('page/europeen');
    }
    public function chineese()
    {
        $this->render('page/chineese');
    }

    public function other()
    {
        $this->render('page/other');
    }

    public function connexion() {
        $this->render('page/connexion');
    }

    public function register() {
        $this->render('page/register');
    }

}