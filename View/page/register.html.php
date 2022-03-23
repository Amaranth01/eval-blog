<h1>Inscription</h1>

    <form action="/index.php?c=user&a=register" method="post" class="form">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="username">Nom ou pseudo</label>
        <input type="text" name="username" id="username">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">

        <label for="passwordR">Répétez votre mot de passe</label>
        <input type="password" name="passwordR" id="passwordR">

        <input type="submit" name="submit" value="submit" class="button">
    </form>