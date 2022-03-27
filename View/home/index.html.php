<h1>Les derniers articles</h1>

<?php

use App\Model\Entity\Article;
use App\Model\Manager\ArticleManager;

foreach (ArticleManager::findAll() as $article) {
    ?>

    <div id="content">
        <div class="article">
            <p class="artTitle"><?= $article->getTitle()?></p>
            <br>

            <p><?=$article->getContent() ?></p>

            <p><a href="/index.php?c=comment&a=index">Ajouter un commentaire</a></p>
        </div>
        <br> <br>
    </div>

    <?php
}
?>
