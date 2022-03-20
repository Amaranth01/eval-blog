<h2>Connectez-vous</h2>

        <form action="/index.php?c=user&a=connexion" method="post">
            <label for="username">username</label>
            <input type="text" name="username" id="username">

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">

            <input type="submit" name="submit" value="submit">
        </form>

    <div>
        <p>Pas de compte ? <a href="/index.php?c=home&a=register">Inscrivez-vous ici.</a></p>
    </div>