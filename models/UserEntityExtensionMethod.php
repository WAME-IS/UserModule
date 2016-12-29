<?php

namespace Wame\UserModule\Models;

use Nette\Security\User;
use Wame\UserModule\Repositories\UserRepository;
use Nette\Utils\ObjectMixin;

class UserEntityExtensionMethod
{
    public function __construct(UserRepository $userRepository)
    {
        ObjectMixin::setExtensionMethod(User::class, 'getentity', function (User $user) use ($userRepository) {
            return $userRepository->getUserById($user->getId());
        });
//        User::extensionMethod('getEntity', function(User $user) use ($userRepository) {
//            return $userRepository->getUserById($user->getId());
//        });
    }

}
