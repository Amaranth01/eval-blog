<?php

use App\Controller\AbstractController;
use App\Model\Entity\Comment;

class CommentController extends AbstractController
{

    public function index()
    {
        $this->render('comment/add-comment');
    }

    public function listComment()
    {
        $this->render('comment/list-comment');
    }

    public function addComment()
    {
        //clean data
        $content = $this->clean($this->getFormField('content'));

        //Checks if the user is logged in
        $author = self::getConnectedUser();
        echo "<pre>";
        var_dump($author);
        echo "</pre>";
        $comment = (new Comment())
            ->setContent($content)
            ->setAuthor($author)
        ;

        $errorMessage = "Le champ doit être rempli";
        if(empty($content)) {
            $_SESSION['errors'][] = $errorMessage;
            $this->render('home/index');
            exit();
        }
        CommentManager::addNewComment($comment);
        $this->render('home/index');
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