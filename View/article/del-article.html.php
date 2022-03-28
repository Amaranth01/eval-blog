<h1>Modération d'article</h1>

<table>
    <tbody>
    <?php

    use App\Model\Entity\Article;

    use App\Model\Entity\AbstractEntity;
    use App\Model\Manager\ArticleManager;

    foreach (ArticleManager::findAll() as $article) {
        ?>

        <tr>
            <td>Titre</td>
            <td class="artTitle"><?= $article->getTitle() ?></td>
        </tr>
        <tr>
            <td>Contenu</td>
            <td><?=$article->getContent() ?></td>
        </tr>
        <tr>
            <td>Modération</td>
            <td> <a href="/index.php?c=article&a=delete-article&id=<?= $article->getId() ?>">Supprimer</a></td>
        </tr>
        <tr>
            <td>Editer</td>
            <td><a href="/index.php?c=article&a=edit-article">Editer</a></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>