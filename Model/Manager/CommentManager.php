<?php

use App\Model\DB;
use App\Model\Entity\Comment;

class CommentManager {

    public static function findAllComment(): Array
    {
        $comment = [];
        $result = DB::getPDO()->query("SELECT * FROM comments ");

        if($result) {
            foreach ($result->fetchAll() as $data) {
                $users[] = self::addNewComment($data);
            }
        }
        return $comment;
    }

    /**
     * @param Comment $comment
     * @return bool
     */
    public static function addNewComment(Comment $comment): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO comments (content, article_id, user_id) VALUES (:content, :article_id, :user_id)
        ");

        $stmt->bindValue(':content', $comment->getContent());
        $stmt->bindValue(':article_id', $comment->getArticle()->getId());
        $stmt->bindValue(':user_id', $comment->getAuthor()->getId());

        $result = $stmt->execute();
        $comment->setId(DB::getPDO()->lastInsertId());
        return $result;
    }

    /**
     * Check that the comment exists in the database by id
     * @param int $id
     * @return int|mixed
     */
    public static function commentExist(int $id)
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM comments WHERE id = '$id'");
        return $result ? $result->fetch(): 0;
    }

    /**
     * @param $newContent
     * @param $id
     */
    public static function updateComment($newContent, $id)
    {
        $stmt = DB::getPDO()->prepare("UPDATE comments 
        SET content = :newContent WHERE id = :id");

        $stmt->bindParam('newContent', $newContent);
        $stmt->bindParam('id', $id);

        $stmt->execute();
    }

    /**
     * @param $id
     * @return false|int
     */
    public static function delComment($id)
    {
        if (self::commentExist($id)) {
            return DB::getPDO()->exec(
                "DELETE FROM article WHERE id = '$id'
            ");
        }
        return false;
    }
}