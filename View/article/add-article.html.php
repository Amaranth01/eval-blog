<h1>Ajouter un article</h1>

<form action="/index.php?c=article&a=add-article" method="post" id="form">

    <label for="title">Titre</label>
    <input type="text" name="title" id="title">

    <label for="content">Contenu</label>
    <textarea name="content" id="content" cols="30" rows="20"></textarea>

    <input type="submit" id="submit" name="submit" value="Envoyer">
</form>