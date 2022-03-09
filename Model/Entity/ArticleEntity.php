<?php

use http\Client\Curl\User;

class ArticleEntity {
    private int $id;
    private string $title;
    private string $content;
    private User $user;

    /**
     * Article constructor.
     * @param string $content
     * @param User $user
     * @param string $title
     * @param int|null $id
     */
    public function __construct(string $content, User $user, string $title, int $id = null) {
        $this->id = $id;
        $this->content = $content;
        $this->user = $user;
        $this->title = $title;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }


}