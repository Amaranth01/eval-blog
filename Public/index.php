<?php

namespace App\View;

use ChineeseController;
use ConnexionController;
use ErrorController;
use EuropeenController;
use HomeController;
use OtherController;
use RegisterController;

require __DIR__ . '/../includes.php';

$page = isset($_GET['c']) ? clean($_GET['c']) : 'home';

switch ($page) {
    case 'home' :
        require __DIR__ . '/../View/base.html.php';
        break;
    case 'base':
        (new HomeController())->render('base');
        break;
    case 'other':
        (new OtherController())->other();
        break;
    case 'europeen-dragon':
        (new EuropeenController())->europeen();
        break;
    case 'chineese-dragon':
        (new ChineeseController())->chineese();
        break;
    case 'connexion':
        (new ConnexionController())->connexion();
        break;
    case 'register':
        (new RegisterController())->register();
        break;
    default :
        (new ErrorController())->error404($page);
}
