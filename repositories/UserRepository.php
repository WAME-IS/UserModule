<?php

namespace Wame\UserModule\Repositories;

use Nette\Utils\Random;
use Nette\Utils\Strings;
use Nette\Security\Passwords;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Entities\UserInfoEntity;
use Wame\Core\Exception\RepositoryException;

class UserRepository extends \Wame\Core\Repositories\BaseRepository
{
	const STATUS_BLOCKED = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_VERIFY_EMAIL = 2;
	
	/** @var UserEntity */
	private $userEntity;	
	
	public function __construct(\Nette\DI\Container $container, \Kdyby\Doctrine\EntityManager $entityManager, \h4kuna\Gettext\GettextSetup $translator, \Nette\Security\User $user) 
	{
		parent::__construct($container, $entityManager, $translator, $user);
		
		$this->userEntity = $this->entityManager->getRepository(UserEntity::class);
	}
	
	
	/**
	 * Get users by criteria
	 * 
	 * @param array $criteria
	 * @param string $orderBy
	 * @param int $limit
	 * @param int $offset
	 * @return UserEntity
	 */
	public function getAll($criteria = [], $orderBy = null, $limit = null, $offset = null)
	{
		return $this->userEntity->findBy($criteria, $orderBy, $limit, $offset);
	}
	
	
	/**
	 * Get one user by criteria
	 * 
	 * @param array $criteria
	 * @param string $orderBy
	 * @return UserEntity
	 */
	public function get($criteria = [], $orderBy = null)
	{
		return $this->userEntity->findOneBy($criteria, $orderBy);
	}
	
	
	/**
	 * Create user
	 * 
	 * @param array $values
	 * @return UserEntity
	 * @throws RepositoryException
	 */
	public function create($values)
	{
		$userInfoEntity = new UserInfoEntity();
		$userInfoEntity->firstName = $values['first_name'];
		$userInfoEntity->lastName = $values['last_name'];
		$userInfoEntity->degree = $values['degree'];
		$userInfoEntity->text = $values['text'];
		
		if ($values['birthdate']) {
			$userInfoEntity->birthdate = $this->formatDate($values['birthdate'], 'Y-m-d');
		} else {
			$userInfoEntity->birthdate = null;
		}
		
		$userEntity = new UserEntity();
		$userEntity->info = $userInfoEntity;
		$userEntity->token = $this->generateToken();
		$userEntity->email = $values['email'];
		$userEntity->password = null;
		$userEntity->registerDate = $this->formatDate('now');
		$userEntity->status = UserRepository::STATUS_VERIFY_EMAIL;

		$create = $this->entityManager->persist($userEntity);

		$this->entityManager->persist($userInfoEntity);

		if (!$create) {
			throw new RepositoryException(_('Could not create the user'));
		}
		
		return $userEntity;
	}
	
	
	/**
	 * Return password and if not exists so generate
	 * 
	 * @param array $values
	 * @return string
	 * @throws RepositoryException
	 */
	public function getPassword($values = [])
	{
		if (array_key_exists('password', $values)) {
			if ($values['password'] && $values['password'] == $values['password_repeat']) {
				$password = $values['password'];
			} else {
				throw new RepositoryException(_('Passwords must be the same'));
			}
		} else {
			$password = Strings::random();
		}

		return $password;
	}
	
	
	/**
	 * Generate token
	 * 
	 * @return string
	 */
	public function generateToken()
	{
		return Random::generate(10);
	}
	
	
	/**
	 * Check email is exists
	 * 
	 * @param string $email
	 * @param mixed $role
	 * @param mixed $without without user ids
	 * @return mixed
	 */
	public function isEmailExists($email, $role = null, $without = null)
	{
		$by = ['email' => $email];
		
		if ($role) {
			if (!is_array($role)) {
				$role = [$role];
			}
			
			$by['role'] = $role;
		}
		
		if ($without) {
			if (!is_array($without)) {
				$without = [$without];
			}
			
			$by['without != ?'] = $without;
		}
		
		$check = $this->userEntity->countBy($by);
		
		if ($check == 0) {
			return null;
		} else {
			throw new RepositoryException(_('The user with this email already exists'));
		}
	}
	
}