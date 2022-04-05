<?php

?>
<form action="/index.php?c=comment&a=update-comment&id=&id" method="post" id="form">

    <label for="content">Mise à jour de l'article</label>
    <textarea name="content" id="content" cols="30" rows="20"><?= CommentManager::getComment($data[0])->getContent() ?></textarea>

    <input type="submit" name="submit">
</form>