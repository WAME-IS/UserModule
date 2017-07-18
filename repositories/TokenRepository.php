<?php

namespace Wame\UserModule\Repositories;

use Nette\Utils\DateTime;
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
        $this->removeByUser($userEntity);

        $tokenEntity = new TokenEntity();
        $tokenEntity->setToken(Security::generateToken());
        $tokenEntity->setUser($userEntity);

        if ($expireDate) {
            if ($expireDate instanceof DateTime) {
                $tokenEntity->setExpireDate($expireDate);
            } else {
                $tokenEntity->setExpireDate(Date::toDateTime($expireDate));
            }
        }

        $this->entityManager->persist($tokenEntity);

        $userEntity->setToken($tokenEntity);

        return $tokenEntity;
    }


    /**
     * Get token by hash and email
     *
     * @param string $hash
     * @param string $email
     *
     * @return TokenEntity
     */
    public function getToken($hash, $email)
    {
	    return $this->get(['token' => $hash, 'user.email' => $email]);
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
     * Remove by token
     *
     * @param string $token
     *
     * @return bool
     */
    public function removeByToken($token)
    {
        $remove = $this->remove(['token' => $token]);

        $this->entityManager->flush();

        return $remove;
    }


    /**
     * Remove by user
     *
     * @param UserEntity $userEntity
     *
     * @return bool
     */
    public function removeByUser($userEntity)
    {
        $remove = $this->remove(['user' => $userEntity]);

        $this->entityManager->flush();

        return $remove;
    }

}
