<?php

namespace Wame\UserModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\UserModule\Entities\TokenEntity;
use Wame\UserModule\Entities\UserEntity;
use Wame\Utils\Date;
use Wame\Utils\Security;


class TokenRepository extends BaseRepository
{
	public function __construct()
    {
		parent::__construct(TokenEntity::class);
	}


    /**
     * Create TokenEntity
     *
     * @param UserEntity $userEntity
     * @param null $expireDate
     *
     * @return TokenEntity
     */
	public function create($userEntity, $expireDate = null)
    {
        $tokenEntity = new TokenEntity();
        $tokenEntity->setToken(Security::generateToken());
        $tokenEntity->setUser($userEntity);

        if ($expireDate) {
            $tokenEntity->setExpireDate(Date::toDateTime(Date::NOW));
        }

        $this->entityManager->persist($tokenEntity);

        return $tokenEntity;
    }


    /**
     * Get token
     *
     * @param string $token
     *
     * @return TokenEntity
     */
    public function getByToken($token)
    {
        return $this->get(['token' => $token]);
    }


    /**
     * Get token by userEntity
     * @param UserEntity $userEntity
     *
     * @return TokenEntity
     */
    public function getByUser($userEntity)
    {
        return $this->get(['user' => $userEntity]);
    }


    /**
     * Remove token
     *
     * @param string $token
     *
     * @return bool
     */
    public function removeByToken($token)
    {
        return $this->remove(['token' => $token]);
    }

}
