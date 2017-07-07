<?php

namespace Wame\UserModule\Models;

use Wame\UserModule\Entities\UserEntity;
use Wame\Utils\Date;
use Wame\Utils\Security;

class Token
{
    /**
     * Check token
     *
     * Check token value and expire date
     *
     * @param UserEntity $userEntity user entity
     * @param string $token token
     * @return bool
     */
    public function check(UserEntity $userEntity, string $token)
    {
        $dbToken = $userEntity->getToken();

        return ( $dbToken->getToken() == $token ) && ( $dbToken->getExpireDate() < Date::toDateTime(Date::NOW) );
    }

    /**
     * Apply token
     *
     * Check and apply token
     *
     * @param UserEntity $userEntity user entity
     * @param string $token token
     * @throws \Exception
     */
    public function apply(UserEntity $userEntity, string $token)
    {
        if(!$this->check($userEntity, $token)) {
            throw new \Exception('Invalid token');
        }

        $userEntity->removeToken();
    }

    public function generate(UserEntity $userEntity)
    {
        $userEntity->getToken()
            ->setToken(Security::generateToken())
            ->setExpireDate(Date::toDateTime(Date::NOW));
    }

}