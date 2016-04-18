<?php

namespace Wame\UserModule\Models;

use Nette\Object;
use Nette\Security;
use Kdyby\Doctrine\EntityManager;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\UserRepository;

class Authenticator extends Object implements Security\IAuthenticator
{
	/** @var \Kdyby\Doctrine\EntityManager */
	private $entityManager;
	
	public function __construct(EntityManager $entityManager) {
		$this->entityManager = $entityManager;
	}
	
	function authenticate(array $credentials)
    {
        list ($email, $password) = $credentials;
				
        $userEntity = $this->entityManager->getRepository(UserEntity::class)->findOneBy(['email' => $email]);
		
        if (!$userEntity) {
            throw new Security\AuthenticationException('Užívateľ s taktýmto emailom sa nenašiel.', self::IDENTITY_NOT_FOUND);
        }
        if (!Security\Passwords::verify($password, $userEntity->password)) {
            throw new Security\AuthenticationException('Zle zadané heslo.', self::INVALID_CREDENTIAL);
        }
        if ($userEntity->status == UserRepository::STATUS_BLOCKED) {
			throw new Security\AuthenticationException('Používateľske konto je blokované.', self::INVALID_CREDENTIAL);
		}
 		if ($userEntity->status == UserRepository::STATUS_VERIFY_PHONE){
			throw new Security\AuthenticationException('Používateľske konto nieje aktivované. Na vaše telefónne číslo sme vám zaslali SMS s aktivačným kódom.', self::INVALID_CREDENTIAL);
		}
 		if ($userEntity->status == UserRepository::STATUS_VERIFY_EMAIL){
			throw new Security\AuthenticationException('Používateľske konto nieje aktivované. Použijte aktivačný link ktorý sme Vám poslali na Váš email.', self::INVALID_CREDENTIAL);
		}
		
		if (Security\Passwords::needsRehash($userEntity->password)) {
			$userEntity->password = Security\Passwords::hash($password);
		}
		
		$userEntity->lastLogin = new \DateTime('now');
		$this->entityManager->persist($userEntity);

        return new Security\Identity($userEntity->id, $userEntity->role, $this->getIdentityData($userEntity));
    }
	
	/**
	 * Return identity data
	 * 
	 * @param Wame\UserModule\Entities\UserEntity $userEntity
	 * @return array
	 */
	private function getIdentityData($userEntity)
	{
		return [
			'lang' => $userEntity->lang,
			'token' => $userEntity->token,
			'email' => $userEntity->email,
			'nick' => $userEntity->nick,
			'registerDate' => $userEntity->registerDate,
			'lastLogin' => $userEntity->lastLogin,
			'status' => $userEntity->status
		];
	}

}
