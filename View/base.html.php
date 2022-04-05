<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog des dragons</title>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body>
<?php
// Handling error messages.
if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);

    foreach($errors as $error) { ?>
        <div class="message error">
            <button name="button" class="close">X</button>
            <?= $error ?>
        </div> <?php
    }
}

// Handling success messages.
if(isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
    ?>
    <div class="message success">
        <button name="button" class="close">X</button>
        <?= $success ?>
    </div> <?php
}
$user = $_SESSION['user'];
echo"<pre>";
var_dump($user);
echo"</pre>";
?>
<h1>L'univers des dragons</h1>

    <nav>
        <ul>
            <li><a href="/index.php?c=home&a=index">Page d'accueil</a></li>
            <li><a href="/index.php?c=article&a=index">Ajouter un article</a></li>
            <?php if(UserController::adminConnected()) {?>
            <li><a href="/index.php?c=admin&a=index">Espace administration</a></li>
            <?php
            }
            ?>
            <?php if(UserController::userConnected()) {?>
            <li><a href="/index.php?c=logout&a=logout">Déconnexion</a></li>
            <?php
            }
            else {
                ?>
                <li><a href="/index.php?c=home&a=connexion">Connexion/Inscription</a></li>
           <?php }
            ?>
        </ul>
    </nav>

  <div id="container">
        <img id="carousel" src="" alt="">
  </div>

<main class="container">
    <?= $html ?>
</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/asset/js/app.js"></script>
<script src=" /asset/js/carousel.js"></script>
</body>
</html>