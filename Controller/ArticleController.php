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

    public function articleManage()
    {
        $this->render('article/del-article');
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

        //Check that the fields are free, otherwise we exit
        $errorMessage = "Un des deux champs est vide. Merci de le remplir";
        if(empty($title) && empty($content)) {
            $_SESSION['errors'][] = $errorMessage;
            $this->render('home/index');
            exit();
        }
        ArticleManager::addNewArticle($article);
    }

    /**
     * @param int $id
     */
    public function deleteArticle(int $id)
    {
        if(ArticleManager::articleExist($id)) {
            ArticleManager::deleteArticle($id);
            var_dump(ArticleManager::deleteArticle($id));
            exit();
        }
    }
}