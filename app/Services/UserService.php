<?php

namespace App\Services;

use App\Contracts\UserContract;
use App\Exceptions\CustomException;
use App\Repositories\UserRepository;

class UserService implements UserContract

{
    public function __construct(private UserRepository $userRepository) {}

    public function import($data)
    {
        try {
            return $this->userRepository->importUsers($data);
        } catch (CustomException $th) {
            throw new CustomException($th->getMessage());
        }
    }
}
