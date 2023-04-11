<?php

declare(strict_types=1);

namespace App\Model\Infrastructure\Admin;

use App\Entity\Admin;
use PDO;

/**
 * An object that encapsulates access to data about administrators in the database
 */
class AdminRepository implements AdminRepositoryInterface
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }


    public function getByName(string $name): ?Admin
    {
        $query = $this->connection->prepare(
            "SELECT * FROM admins WHERE name = :name"
        );
        $query->execute(['name' => $name]);
        $data = $query->fetch();
        if ($data === false) {
            return null;
        } else {
            $admin = new Admin($data['id']);
            $admin->setName($data['name']);
            $admin->setPasswordHash($data['password_hash']);
            return $admin;
        }
    }
}