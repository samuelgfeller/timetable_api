<?php
declare(strict_types=1);

namespace App\Domain\User;

use User;


interface UserRepositoryInterface {
    /**
     * @return User[]
     */
    public function findAllUsers(): array;

    /**
     * Return user with given id if it exists
     * otherwise null
     *
     * @param int $userId
     * @return User|null
     */
    public function findUserById(int $userId): ?User;

    /**
     * Returns user with given id
     * If it doesn't exist, it throws an UserNotFoundException
     *
     * @param int $userId
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserById(int $userId): User;

    public function insertUser(array $data): int;

    public function deleteUser(int $userId): bool;

    public function updateUser(int $userId, array $data): bool;
}
