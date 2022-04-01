<?php

use App\Controller\AbstractController;
use App\Model\Entity\Comment;
use App\Model\Manager\ArticleManager;

class CommentController extends AbstractController
{
    public function index()
    {
        if((new App\Model\Entity\User)->getId() === 2 ) {
            $this->render('comment/add-comment');
        }
        else {
            $errorMessage = "Il faut être connecté pour laisser un commentaire";
            $_SESSION['errors'] [] = $errorMessage;
            $this->render('home/index');
        }

    }

    public function listComment()
    {
        $this->render('comment/all-comment');
    }

    /**
     * @param int $id
     */
    public function addComment(int $id)
    {
        //clean data
        $content = $this->clean($this->getFormField('content'));

        //Checks if the user is logged in
        $author = self::getConnectedUser();
        $comment = (new Comment())
            ->setContent($content)
            ->setAuthor($author)
        ;

        //Check that the fields are free, otherwise we exit
        $errorMessage = "Le champ doit être rempli";
        if(empty($content)) {
            $_SESSION['errors'][] = $errorMessage;
            $this->render('home/index');
            exit();
        }

        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $commentManager->addNewComment($comment, $id);
        $this->render('home/index', [
            'article' => $articleManager->getArticle($id)
        ]);
    }

    public function updateComment($id)
    {
        //We check that the input fields are complete
        if (!isset($_POST['content'])) {
            $this->render('home/index');
            exit();
        }

        $newContent = $this->clean($_POST['content']);

        $comment = new CommentManager();
        $comment->updateComment($newContent, $id);
    }
}