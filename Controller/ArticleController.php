<?php

use App\Controller\AbstractController;
use App\Model\Entity\Article;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\UserManager;

class ArticleController extends AbstractController
{

    public function index()
    {
        $this->render('article/add-article');
    }

    /**
     * Encodes article content.
     */
    public function addArticle()
    {
        //Clean data
        $title = $this->clean($this->getFormField('title'));
        $content = $this->clean($this->getFormField('content'));

        //Checks if the user is logged in
        $author = self::getConnectedUser();

        $article = (new Article())
            ->setTitle($title)
            ->setContent($content)
            ->setAuthor($author)
        ;
        ArticleManager::addNewArticle($article);
    }
}