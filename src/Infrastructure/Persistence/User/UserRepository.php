<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Persistence\DataManager;
use Cake\Database\Connection;
use User;


class UserRepository extends DataManager implements UserRepositoryInterface
{

    private $table = 'user';
    /**
     * {@inheritdoc}
     */
    public function findAllUsers(): array
    {
        return $this->findAll($this->table);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserById(int $id): User
    {
        return $this->selectAndFetchSingleData('select * from user where and id = '.$id.';');
    }

    public function getUserById(int $id): User
    {
        $users = ['test' => 'test'];
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $users[$id];
    }

    public function insertUser(array $data): int {
        // TODO: Implement insertUser() method.
    }

    public function deleteUser(int $userId): bool {
        // TODO: Implement deleteUser() method.
    }

    public function updateUser(int $userId, array $data): bool {
        // TODO: Implement updateUser() method.
    }
}
