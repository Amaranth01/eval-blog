<h1>Connectez-vous</h1>

        <form action="/index.php?c=user&a=connexion" method="post" id="form">
            <label for="username">Pseudo</label>
            <input type="text" name="username" id="username">

            <label for="email">Email</label>
            <input type="email" name="email" id="email">

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">

            <input type="submit" name="submit" value="submit">
        </form>

    <div id="register">
        <p>Pas de compte ? <a href="/index.php?c=home&a=register">Inscrivez-vous ici.</a></p>
    </div>