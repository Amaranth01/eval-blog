<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Article;
use DateTime;

class ArticleManager
{
    /**
     * Return all users.
     * @return array
     */
    public static function findAll(): array
    {
        $articles = [];
        $query = DB::getPDO()->query("SELECT * FROM  article");
        if($query) {
            $userManager = new UserManager();
            $format = 'Y-m-d H:i:s';

            foreach($query->fetchAll() as $articleData) {
                $articles[] = (new Article())
                    ->setId($articleData['id'])
                    ->setAuthor($userManager->getUser($articleData['user_id']))
                    ->setContent($articleData['content'])
                    ->setTitle($articleData['title'])
                ;
            }
        }

        return $articles;
    }

    /**
     * Add a new article into the db.
     * @param Article $article
     * @return void
     */
    public static function addNewArticle(Article $article): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO article (title, content, user_id) VALUES (:title, :content, :user_id)
        ");

        $stmt->bindValue(':title', $article->getTitle());
        $stmt->bindValue(':content', $article->getContent());
        $stmt->bindValue(':user_id', $article->getAuthor()->getId());

        $result = $stmt->execute();
        $article->setId(DB::getPDO()->lastInsertId());
        return $result;
    }

    /**
     * Check that the article exists in the database by id
     * @param int $id
     * @return int|mixed
     */
    public static function articleExist(int $id)
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM article WHERE id = '$id'");
        return $result ? $result->fetch(): 0;
    }

    /**
     * Deletes an item from the database by id
     * @param Article $article
     * @return false|int
     */
    public static function deleteArticle(Article $article)
    {
        if (self::articleExist($article->getId())) {
            return DB::getPDO()->exec(
                "DELETE FROM article WHERE id = {$article->getId()}
            ");
        }
        return false;
    }
}








