<?php

class Error {
    /**
     * Control the error page.
     * @param string $E404
     * @return void
     */
    public function error404(string $E404)
    {
        require __DIR__ . '/../View/error.html.php';
    }
}