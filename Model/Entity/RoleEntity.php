<?php

class RoleEntity {
    private int $id;
    private string $role_name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->role_name;
    }

    /**
     * @param string $role_name
     */
    public function setRoleName(string $role_name): void
    {
        $this->role_name = $role_name;
    }


}