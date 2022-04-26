<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return User::get();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user)
    {
        return $user->save();
    }

    /**
     * @param string $userEmail
     * @param string|null $userName
     * @return User|null
     */
    public function updateOrCreate(string $userEmail, ?string $userName): ?User
    {
        return User::updateOrCreate(
            ['user_name' => $userName, 'user_email' => $userEmail],
            ['user_name' => $userName, 'user_email' => $userEmail]
        );
    }
}
