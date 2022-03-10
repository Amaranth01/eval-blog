<?php

namespace App\View;

use ErrorController;
use HomeController;

require __DIR__ . '/../includes.php';

$page = isset($_GET['c']) ? clean($_GET['c']) : 'home';
$method = isset($_GET['a']) ? clean($_GET['a']) : 'index';

switch ($page) {
    case 'home' :
        require __DIR__ . '/../View/base.html.php';
        break;
    case 'base':
        (new HomeController())->render('base');
        break;
    case 'other':
        (new HomeController())->render('different-dragon/other');
        break;
    case 'europeen-dragon':
        (new HomeController())->render('different-dragon/europeen-dragon');
        break;
    case 'chineese-dragon':
        (new HomeController())->render('different-dragon/chineese-dragon');
        break;
    default :
        (new ErrorController())->error404($page);
}
