<?php

namespace Wame\UserModule\Models;

use Nette\Security\User;
use Wame\UserModule\Repositories\UserRepository;

class UserEntityExtensionMethod
{

    public function __construct(UserRepository $userRepository)
    {
//        User::extensionMethod('getEntity', function(User $user) use ($userRepository) {
//            return $userRepository->getUserById($user->getId());
//        });
    }
}
