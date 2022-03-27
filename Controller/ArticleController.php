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

    public function editArticle()
    {
        $this->render('article/update-article');
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
        $this->render('home/index');
    }

    /**
     * @param int $id
     */
    public function deleteArticle(int $id)
    {
        if(ArticleManager::articleExist($id)) {
            $deleted = ArticleManager::deleteArticle($id);
            $this->render('home/index');
        }
    }

    public function updateArticle($id)
    {
        //We check that the input fields are complete
        if (!isset($_POST['title']) || !isset($_POST['content'])) {
            $this->render('home/index');
            exit();
        }

        $newTitle = $this->clean($_POST['title']);
        $newContent = $this->clean($_POST['content']);

        $article= new ArticleManager();
        if ($_SESSION['user']->getId() !== $article->articleExist($id)->getUser()->getId()) {
            $this->render('home/index');
            exit();
        }
        $article->updateArticle($newTitle, $newContent, $id);
    }
}