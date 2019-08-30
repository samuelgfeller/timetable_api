<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepositoryInterface;
use User;


class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User[]
     */
    private $users;

    /**
     * UserRepositoryInterface constructor.
     *
     * @param array|null $users
     */
    public function __construct(array $users = null)
    {
    
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return DataManager::selectAndFetchAssocMultipleData('SELECT x,y,date FROM location;');
    }
    
    public function insert(\Location $location)
    {
        return DataManager::insert('location',PopulateArray::populateLocationArray($location));
    }
    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }
}
