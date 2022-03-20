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
        <div class="alert alert-error"><?= $error ?></div> <?php
    }
}

// Handling sucecss messages.
if(isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    unset($_SESSION['success']);
    ?>
    <div class="alert alert-success"><?= $message ?></div> <?php
}
?>
<h1>L'univers des dragons</h1>

  <div id="container">
        <img id="carousel" src="" alt="">
  </div>


<nav>
    <ul>
        <li><a href="/index.php?c=home&a=index">Page d'accueil</a></li>
        <li><a href="/index.php?c=home&a=europeen">Les dragon européens</a></li>
        <li><a href="/index.php?c=home&a=chineese">Les dragons asiatiques</a></li>
        <li><a href="/index.php?c=home&a=other">Les autres dragons</a></li>
        <li><a href="/index.php?c=home&a=connexion">Connexion/Inscription</a></li>
    </ul>
</nav>

<main class="container">
    <?= $html ?>
</main>

<script src=" /asset/js/carousel.js"
<script src="/asset/js/app.js"></script>
</body>
</html>