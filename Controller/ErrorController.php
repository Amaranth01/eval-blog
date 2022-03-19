<?php

namespace App;

class ErrorController
{
    /**
     * Control the error page.
     * @return void
     */
    public function error404()
    {
        require __DIR__ . '/../View/error/404.html.php';
    }
}