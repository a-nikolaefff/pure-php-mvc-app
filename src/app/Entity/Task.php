<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;

class Task
{
    private ?int $id;
    private string $userName;
    private string $userEmail;
    private string $description;
    private bool $isDone;
    private DateTime $createdAt;

    /**
     * @param ?int $id
     */
    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @param string $userEmail
     */
    public function setUserEmail(string $userEmail): void
    {
        $this->userEmail = $userEmail;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param bool $isDone
     */
    public function setIsDone(bool $isDone): void
    {
        $this->isDone = $isDone;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->isDone;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}