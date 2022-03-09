<?php

//FIXME voir pourquoi la redirection URL ne marche pas

use App\Controller\AbstractController;

require __DIR__ . '/../includes.php';

$page = isset($_GET['c']) ? clean($data) : 'home';

switch ($page) {
    case 'home' :
        require __DIR__ . '/../View/base.html.php';
        break;
    case 'chineese-dragon';
        require __DIR__ . '/../View/different-dragon/chineese-dragon.html.php';
        break;
    default :
        (new ErrorController())->error404($page);
}
