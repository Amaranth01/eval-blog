<?php

namespace App\Controller;

use App\Model\Entity\User;

abstract class AbstractController
{
    abstract public function index();

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

    protected static function clean(string $data): string
    {
        $data = trim($data);
        $data = strip_tags($data);
        $data = htmlentities($data);

        if ($data < 0 || $data > 100) {
            $data = 15;
        }

        return $data;
    }

    /**
     * @return bool
     */
    public function formSubmitted(): bool
    {
        return isset($_POST['submit']);
    }

    /**
     * Returns a form field value
     * @param string $field
     * @param null $default
     * @return mixed|string
     */
    public function getFormField(string $field, $default = null)
    {
        if (!isset($_POST[$field])) {
            return (null === $default) ? '' : $default;
        }

        return $_POST[$field];
    }

    /**
     * Checks if a user is already logged in
     * @return bool
     */
    public static function userConnected(): bool
    {
        return isset($_SESSION['user']) && null !== ($_SESSION['user'])->getId();
    }

    /**
     * Returns a logged-in user, or null if not logged in.
     * @return User|null
     */
    public function getConnectedUser(): ?User
    {
        if(!self::userConnected()) {
            return null;
        }
        return ($_SESSION['user']);
    }
}