<?php


namespace App\Domain\User;

class UserService {
    
    private $userRepositoryInterface;
    
    public function __construct(UserRepositoryInterface $userRepositoryInterface) { 
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function findAllUsers() {
        $allUsers= $this->userRepositoryInterface->findAllUsers();
        return $allUsers;
    }
    
}