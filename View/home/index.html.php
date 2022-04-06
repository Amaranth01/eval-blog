<h1 id="titleArt">Les derniers articles</h1>

<?php

use App\Model\Entity\Article;
use App\Model\Manager\ArticleManager;

foreach (ArticleManager::findAll() as $article) {
    ?>

    <div id="contentArticle">
        <div class="article">
            <p class="artTitle"><?= $article->getTitle()?></p>
            <br>

            <p><?=$article->getContent() ?></p>

            <p><a href="/index.php?c=comment&a=page-add-comment&id=<?=$article->getId() ?>">Ajouter un commentaire</a></p>
        </div>
        <br> <br>
    </div>


    <?php
}?>


    <h2 id="titleComment">Les derniers commentaires</h2>
    <?php
    foreach (CommentManager::findAllComment(5) as $comment) {
        ?>
        <div id="contentComment" >
            <div class="comment">
                <p class="artTitle"><?= $comment->getContent()?></p>
                <br>
            </div>
            <br> <br>
        </div>
     <?php
        }
    ?>