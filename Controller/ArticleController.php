<?php

use App\Controller\AbstractController;
use App\Model\Entity\Article;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\UserManager;

class ArticleController extends AbstractController {

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function addArticle() {
        if($this->isFormSubmitted()) {

            $user = UserManager::getUser((int)$_SESSION);

            // Getting Article data from form.
            $title = $this->clean($this->getFormField('title'));
            $content = $this->clean($this->getFormField('content'));


            $article = new Article();
            $article
                ->setTitle($title)
                ->setContent($content)
                ->setAuthor($user);

            // Saving new article.
            if (ArticleManager::addNewArticle($article)) {
                (new HomeController())->render('base', [
                    'article' => $article,
                ]);
            }
        }
        (new HomeController())->render('base');;
    }


}