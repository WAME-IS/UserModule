<?php

namespace Wame\UserModule\Models;

use Nette\Object;
use Nette\Security;
use Kdyby\Doctrine\EntityManager;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\UserRepository;

class Authenticator extends Object implements Security\IAuthenticator
{
	/** @var UserEntity */
	private $userEntity;
	
	
	public function __construct(EntityManager $entityManager) 
	{
		$this->userEntity = $entityManager->getRepository(UserEntity::class);
	}
	
	
	function authenticate(array $credentials)
    {
        list ($email, $password) = $credentials;
				
        $userEntity = $this->userEntity->findOneBy(['email' => $email]);
		
        $this->verify($userEntity, $password);
		
		if (Security\Passwords::needsRehash($userEntity->password)) {
			$userEntity->password = Security\Passwords::hash($password);
		}
		
		$userEntity->lastLogin = new \DateTime('now');

        return new Security\Identity($userEntity->id, $userEntity->role, $this->getIdentityData($userEntity));
    }
	
	
	private function verify($userEntity, $password)
	{
		if (!$userEntity) {
            throw new Security\AuthenticationException(_('The user with this email not found.'), self::IDENTITY_NOT_FOUND);
        }
		
        if (!Security\Passwords::verify($password, $userEntity->password)) {
            throw new Security\AuthenticationException(_('Wrong password entered.'), self::INVALID_CREDENTIAL);
        }
		
        if ($userEntity->status == UserRepository::STATUS_BLOCKED) {
			throw new Security\AuthenticationException(_('The user account is blocked.'), self::INVALID_CREDENTIAL);
		}
		
 		if ($userEntity->status == UserRepository::STATUS_VERIFY_EMAIL){
			throw new Security\AuthenticationException(_('The user account is not activated. Use the activation link sent to you at your email.'), self::INVALID_CREDENTIAL);
		}
		
 		if ($userEntity->status == UserRepository::STATUS_RESET_PASSWORD){
			throw new Security\AuthenticationException(_('You have requested to change your password. To your inbox you will be sent an email with a link to change your password.'), self::INVALID_CREDENTIAL);
		}
	}
	
	
	/**
	 * Return identity data
	 * 
	 * @param UserEntity $userEntity
	 * @return array
	 */
	private function getIdentityData($userEntity)
	{
		return [
			'lang' => $userEntity->lang,
			'token' => $userEntity->token,
			'email' => $userEntity->email,
			'nick' => $userEntity->nick,
			'name' => $userEntity->name,
			'fullName' => $userEntity->fullName,
			'birthdate' => $userEntity->info->birthdate,
			'gender' => $userEntity->info->gender,
			'registerDate' => $userEntity->registerDate,
			'lastLogin' => $userEntity->lastLogin,
			'status' => $userEntity->status
		];
	}

}
