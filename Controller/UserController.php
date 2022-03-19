<?php

use App\Controller\AbstractController;
use App\Model\Entity\User;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('user/users-list', [
            'users_list' => UserManager::getAll()
        ]);
    }

    public function formField(string $field, $default = null)
    {
        if (!isset($_POST[$field])) {
            return (null === $default) ? '' : $default;
        }

        return $_POST[$field];
    }



    /**
     * Cleans and checks the security of elements
     */
    public function register ()
    {

        if ($this->isFormSubmitted()) {
            $mail = $this->clean($this->formField('email'));
            $username = $this->clean($this->formField('username'));
            $password = $this->formField('password');
            $passwordR = $this->formField('passwordR');

            $error = [];
            $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

            // Send a message if the email address is not valid.
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $error[] = "L'adresse mail n'est pas valide";
            }

            // Returns an error if the username is not 2 characters
            if (!strlen($username) >= 2) {
                $error[] = "Le firstname ne fait pas au moins 2 chars";
            }

            // Returns an error if the password does not contain all the requested characters.
            if (!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
                $error[] = "Le mot de passe doit contenir une majuscule, un chiffre et un caractère spécial";
            }

            // Passwords do not match
            if ($password !== $passwordR) {
                $error[] = "Les password ne correspondent pas";
            }

            //Handles in-session message save errors
            if (count($error) > 0) {
                $_SESSION['errors'] = $error;
            } else {
                //If no error is detected the program goes to else and authorizes the recording

                $user = new User();
            }
        }
    }

        /**
         * User login
         * @return void
         */
        public function login()
        {

            if($this->isFormSubmitted()) {
                $errorMessage = "L'utilisateur / le password est mauvais";
                $mail = $this->clean($this->getFormField('email'));
                $password = $this->getFormField('password');

                $user = UserManager::getUserByMail($mail);
                if (null === $user) {
                    $_SESSION['errors'][] = $errorMessage;
                }
                else {
                    if (password_verify($password, $user->getPassword())) {
                        $user->setPassword('');
                        $_SESSION['user'] = $user;
                    }
                    else {
                        $_SESSION['errors'][] = $errorMessage;
                    }
                }
            }

            (new HomeController())->render('base');;
        }


}