<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $userEmail
     * @param string|null $userName
     * @return User|null
     */
    public function updateOrCreate(string $userEmail, ?string $userName): ?User
    {
        return $this->userRepository->updateOrCreate($userEmail, $userName);
    }
}
