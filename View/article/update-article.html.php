
<h1>Modifier un article</h1>

<?php

use App\Model\Manager\ArticleManager;

?>

<!--<form action="/index.php?c=article&a=edit-article&id=--><?//= ArticleManager::articleExist($id) ?><!--" method="post" id="form">-->

    <label for="title">Mise à jour du titre</label>
    <input type="text" name="title" value="" id="title">

    <label for="content">Mise à jour de l'article</label>
    <textarea name="content" id="content" cols="30" rows="20"></textarea>

    <input type="submit" name="submit">
</form>