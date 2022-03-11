<?php

namespace App\Controller;

abstract class AbstractController {

     /**
     * @param string $view
     * @param array $data
     * @return void
     */
    /**
     * @param string $template
     * @param array $data
     * @return void
     */
    public function render(string $template, array $data = [])
    {
        ob_start();
        require __DIR__ . '/../View/' . $template . '.html.php';
        $html = ob_get_clean();
        require __DIR__ . '/../View/base.html.php';
    }
}