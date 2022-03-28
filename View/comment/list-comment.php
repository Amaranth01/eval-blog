<table>
    <tbody>
    <?php

    foreach (CommentManager::findAllComment() as $comment) {
        ?>
        <tr>
            <td>Contenu</td>
            <td><?=$comment->getContent() ?></td>
        </tr>
        <tr>
            <td>Modération</td>
            <td> <a href="/index.php?c=article&a=delete-article&id=<?= $comment->getId() ?>">Supprimer</a></td>
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