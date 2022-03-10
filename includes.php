<?php

require __DIR__ . '/Config.php';
require __DIR__ . '/Model/DB.php';

require __DIR__ . '/Controller/AbstractController.php';
require __DIR__ . '/Controller/ArticleController.php';
require __DIR__ . '/Controller/CommentsController.php';
require __DIR__ . '/Controller/RoleController.php';
require __DIR__ . '/Controller/UserController.php';
require __DIR__ . '/Controller/ErrorController.php';
require __DIR__ . '/Controller/HomeController.php';

require __DIR__ . '/Model/Entity/ArticleEntity.php';
require __DIR__ . '/Model/Entity/CommentsEntity.php';
require __DIR__ . '/Model/Entity/RoleEntity.php';
require __DIR__ . '/Model/Entity/UserEntity.php';

require __DIR__ . '/Model/Manager/ArticleManager.php';
require __DIR__ . '/Model/Manager/CommentsManager.php';
require __DIR__ . '/Model/Manager/RoleManager.php';
require __DIR__ . '/Model/Manager/UserManager.php';

require __DIR__ . '/partials/func/clean.php';
require __DIR__ . '/partials/func/pswd.php';

session_start();