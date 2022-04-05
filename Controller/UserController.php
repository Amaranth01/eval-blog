<?php

use App\Controller\AbstractController;
use App\Model\Entity\User;
use App\Model\Manager\RoleManager;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('page/admin', [
            'users_list' => UserManager::getAll()
        ]);
    }

    /**
     * Checks that the form fields are present
     * @param string $field
     * @param null $default
     * @return mixed|string
     */
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

        if ($this->formSubmitted()) {
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
                $error[] = "Le nom, ou pseudo, doit faire au moins 2 caractères";
            }

            // Returns an error if the password does not contain all the requested characters.
            if (!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
                $error[] = "Le mot de passe doit contenir une majuscule, un chiffre et un caractère spécial";
            }

            // Passwords do not match
            if ($password !== $passwordR) {
                $error[] = "Les mots de passe ne correspondent pas";
            }

            //Count the mistakes
            if (count($error) > 0) {
                $_SESSION['errors'] = $error;
            } else {
                //If no error is detected the program goes to else and authorizes the recording
                $user = new User();
                $role = RoleManager::getRoleByName('user');
                $user
                    ->setUsername($username)
                    ->setEmail($mail)
                    ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                    ->setRole($role)
                    ;
                //If no email is found, we launch the addUser function
                if(0 == UserManager::mailExists($user->getEmail())['count(*)']) {
                    UserManager::addUser($user);
                    //If the ID is not null, we pass the user in the session
                    if (null!== $user->getId()) {
                        $_SESSION['success'] = "Félicitations votre compte est actif";
                        $user->setPassword('');
                        $_SESSION['user'] = $user;
                    }
                    else {
                        $_SESSION['errors'] = ["Impossible de vous enregistrer"];
                    }
                }
                else {
                    $_SESSION['errors'] = ["Cette adresse mail existe déjà !"];
                }
            }
        }
        $this->render('page/register');
    }

        /**
         * User login
         * @return void
         */
        public function connexion()
        {

            if($this->formSubmitted()) {
                $errorMessage = "Votre nom d'utilisateur, ou le mot de passe est incorrect";
                $mail = $this->clean($this->formField('email'));
                $password = $this->formField('password');
                $username = $this->clean($this->formField('username'));

                //Check that the fields are not empty
                if (empty($mail) || empty($password) || empty($username)) {
                    $errorMessage = "L'un des champ est manquant";
                    $_SESSION['errors'][] = $errorMessage;
                    $this->render('home/index');
                    exit();
                }
                //Traces the user by his email to verify that he exists
                $user = UserManager::getUserByMail($mail);
                if (null === $user) {
                    $errorMessage = "Adresse mail inconnue";
                    $_SESSION['errors'][] = $errorMessage;
                }
                else {
                    //Compare the password entered and written in the DB
                    if (password_verify($password, $user->getPassword())) {
                        $user->setPassword('');
                        $_SESSION['user'] = $user;
                    }
                    else {
                        $_SESSION['errors'][] = $errorMessage;
                    }
                }
            }
            $successMessage = "Vous êtes connecté";
            $_SESSION['success'] = $successMessage;
            $this->render('home/index');
        }

    /**
     * Deleting a user
     * @param int $id
     * @return void
     */
    public function deleteUser(int $id)
    {
        if(!self::adminConnected()) {
            $errorMessage = "Seul un administrateur peut supprimer un utilisateur";
            $_SESSION['errors'] [] = $errorMessage;
            $this->render('home/index');
            exit();
        }

        if(UserManager::userExists($id)) {
            $user = UserManager::getUser($id);
            $deleted = UserManager::deleteUser($user);
        }
        $this->index();
    }
}