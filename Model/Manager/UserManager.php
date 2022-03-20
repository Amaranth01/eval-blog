<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Role;
use App\Model\Entity\User;

final class UserManager
{
    public const TABLE = 'user';
    public const TABLE_USER_ROLE = 'user_role';

    /**
     * Return all available users.
     * @return array
     */
    public static function getAll(): array
    {
        $users = [];
        $result = DB::getPDO()->query("SELECT * FROM " . self::TABLE);

        if($result) {
            foreach ($result->fetchAll() as $data) {
                $users[] = self::makeUser($data);
            }
        }
        return $users;
    }


    /**
     * Return current users count.
     * @return int
     */
    public static function getUsersCount(): int
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM " . self::TABLE);
        return $result ? $result->fetch() : 0;
    }


    /**
     * Return a user based on its id.
     * @param int $id
     * @return User
     */
    public static function getUser(int $id): ?User
    {
        $result = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $result ? self::makeUser($result->fetch()) : null;
    }

    /**
     * Fetch a user by mail
     * @param string $email
     * @return User|null
     */
    public static function getUserByMail(string $email): ?User
    {
        $stmt = DB::getPDO()->prepare("SELECT * FROM " . self::TABLE . " WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        return $stmt->execute() ? self::makeUser($stmt->fetch()) : null;
    }


    /**
     * Check if a user exists with this id.
     * @param int $id
     * @return bool
     */
    public static function userExists(int $id): bool
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM " . self::TABLE . " WHERE id = $id");
        return $result ? $result->fetch() : 0;
    }


    /**
     * Return all available user by given role
     * @param Role $role
     * @return array
     */
    public static function getUsersByRole(Role $role): array
    {
        $users = [];
        $usersQuery = DB::getPDO()->query("
            SELECT * FROM " . self::TABLE . " WHERE id IN (SELECT user_id FROM user_role WHERE role_id = {$role->getId()});
        ");

        if($usersQuery){
            foreach($usersQuery->fetchAll() as $userData) {
                $users[] = self::makeUser($userData);
            }
        }

        return $users;
    }


    /**
     * Delete a user from user db.
     * @param User $user
     * @return bool
     */
    public static function deleteUser(User $user): bool {
        if(self::userExists($user->getId())) {
            return DB::getPDO()->exec("
            DELETE FROM " . self::TABLE . " WHERE id = {$user->getId()}
        ");
        }
        return false;
    }


    /**
     * Create a new User Entity
     * @param array $data
     * @return User
     */
    private static function makeUser(array $data): User
    {
        $user = (new User())
            ->setId($data['id'])
            ->setEmail($data['email'])
            ->setUsername($data['username'])
            ->setPassword($data['password'])
        ;

        return $user->setRoles(RoleManager::getRolesByUser($user));
    }


    /**
     * @param User $user
     * @return bool
     */
    public static function addUser(User $user): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO ".self::TABLE." (email, username, password) 
            VALUES (:email, :username, :password)
        ");

        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':password', $user->getPassword());

        $result = $stmt->execute();
        $user->setId(DB::getPDO()->lastInsertId());
        if($result) {
            $role = RoleManager::getRoleByName(RoleManager::ROLE_USER);
            $resultRole = DB::getPDO()->exec("
                INSERT INTO ".self::TABLE_USER_ROLE. " (user_id, role_id) VALUES (".$user->getId().", ".$role->getId().")
            ");

        }
        return $result && $resultRole;
    }


}