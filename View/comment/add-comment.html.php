<h1>Ajouter un commentaire</h1>

<form action="/index.php?c=comment&a=add-comment&id=<?=$data[0]?>" method="post" id="form">

    <label for="content">Contenu</label>
    <textarea name="content" id="content" cols="50" rows="20"></textarea>

    <input type="submit" id="submit" name="submit">
</form>