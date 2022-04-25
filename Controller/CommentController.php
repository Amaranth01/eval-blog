<?php

use App\Controller\AbstractController;
use App\Model\DB;
use App\Model\Entity\Article;
use App\Model\Entity\Comment;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\UserManager;

class CommentController extends AbstractController
{
    public function index()
    {

    }

    public function pageAddComment(int $id){
        $this->render('comment/add-comment', $data=[$id]);
    }

    public function listComment()
    {
        $this->render('comment/list-comment');
    }

    public function editComment(int $id) {
        $this->render('comment/update-comment', $data=[$id]);
    }

    /**
     * @param int|null $id
     */
    public function addComment(int $id)
    {
        //clean data
        $content = $this->clean($this->getFormField('content'));

        //Checks if the user is logged in
        $author = self::getConnectedUser();
        $errorMessage = "Il faut être connecter pour pouvoir écrire un commentaire";
        $_SESSION['errors'] = $errorMessage;

        //Verification that the article exists by its ID

        $article = ArticleManager::articleExist($id);
        //If it does not exist then it is returned to the index
        if ($article === false) {
            $this->render('home/index');
            exit();
        }

        //Creating a new comment object
        $comment = (new Comment())
            ->setContent($content)
            ->setArticle(ArticleManager::getArticle($id))
            ->setAuthor($author)
        ;

        //Check that the fields are free, otherwise we exit
        $errorMessage = "Le champ doit être rempli";
        if(empty($content)) {
            $_SESSION['errors'] = $errorMessage;
            $this->render('home/index');
            exit();
        }

        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $commentManager->addNewComment($comment);
        $this->render('home/index', [
            'article' => $articleManager->getArticle($id)
        ]);
    }

    /**
     * @param $id
     */
    public function updateComment($id)
    {
        //We check that the input fields are complete
        if (!isset($_POST['content'])) {
            $this->render('home/index');
            exit();
        }

        $newContent = $this->clean($_POST['content']);

        $commentManager = new CommentManager($newContent, $id);
        $commentManager->updateComment($newContent, $id);
        $this->render('admin/index');
    }

    public function deleteComment(int $id) {
        if(CommentManager::commentExist($id)) {
            $deleted = CommentManager::delComment($id);
            $this->render('admin/index');
        }
    }
}