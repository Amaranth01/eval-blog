<?php

namespace App\Controller;

class AbstractController {
    /**
     * @param string $view
     * @param array $data
     * @return void
     */
    public function render(string $view, array $data = [])
    {
        ob_start();
        require __DIR__ . '/View/' . $view . '.html.php';
        $html = ob_get_clean();
        require __DIR__ . '/../View/base.html.php';
    }
}