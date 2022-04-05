<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Role;
use App\Model\Entity\User;

class UserManager
{
    /**
     * Returns all users
     * @return array
     */
    public static function getAll(): array
    {
        $users = [];
        $result = DB::getPDO()->query("SELECT * FROM user ");

        if($result) {
            foreach ($result->fetchAll() as $data) {
                $users[] = self::createUser($data);
            }
        }
        return $users;
    }

    /**
     * Create a new User
     * @param array $data
     * @return User
     */
    private static function createUser(array $data): User
    {
        //Retrieve the role id to prepare the assignment
        $role = RoleManager::getRoleById($data['role_id']);
        //Prepare the creation of the new user
        return (new User())
            ->setId($data['id'])
            ->setEmail($data['email'])
            ->setUsername($data['username'])
            ->setPassword($data['password'])
            ->setRole($role)
        ;
    }

    /**
     * Check if a user exists with this mail.
     * @param string $mail
     * @return array|null
     */
    public static function userExists(string $mail): ?array
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM user WHERE email = '$mail'");
        return $result ? $result->fetch() : null;
    }

    /**
     * Find a user with their id.
     * @param int $id
     * @return User
     */
    public static function getUser(int $id): ?User
    {
        $result = DB::getPDO()->query("SELECT * FROM user WHERE id = '$id'");
        return $result ? self::createUser($result->fetch()) : null;
    }

    /**
     * Find a user by email
     * @param string $email
     * @return User|null
     */
    public static function getUserByMail(string $email): ?User
    {
        $stmt = DB::getPDO()->prepare("SELECT * FROM user WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        return $stmt->execute() ? self::createUser($stmt->fetch()) : null;
    }

    /**
     * Delete a user
     * @param User $user
     * @return bool
     */
    public static function deleteUser(User $user): bool {
        if(self::userExists($user->getId())) {
            return DB::getPDO()->exec("
            DELETE FROM user WHERE id = {$user->getId()}
        ");
        }
        return false;
    }

    /**
     * Checks if an email address is already present in the DB.
     * @param string $mail
     * @return array
     */
    public static function mailExists(string $mail): ?array
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM user WHERE email = '$mail'");
        return $result->fetch();
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function addUser(User $user): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO user (email, username, password, role_id) 
            VALUES (:email, :username, :password, :role_id)
        ");

        $stmt->bindValue('email', $user->getEmail());
        $stmt->bindValue('username', $user->getUsername());
        $stmt->bindValue('password', $user->getPassword());
        $stmt->bindValue('role_id', $user->getRole()->getId());

        $result = $stmt->execute();
        $user->setId(DB::getPDO()->lastInsertId());

        return $result;
    }
}