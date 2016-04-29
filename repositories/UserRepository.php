<?php

namespace Wame\UserModule\Repositories;

use Nette\Utils\Random;
use Nette\Utils\Strings;
use Wame\UserModule\Entities\UserEntity;
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
		parent::__construct($container, $entityManager, $translator, $user, UserEntity::class);
		
		$this->userEntity = $this->entityManager->getRepository(UserEntity::class);
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
	 * Get users by criteria
	 * 
	 * @param array $criteria
	 * @param string $orderBy
	 * @param int $limit
	 * @param int $offset
	 * @return UserEntity
	 */
	public function find($criteria = [], $orderBy = null, $limit = null, $offset = null)
	{
		return $this->userEntity->findBy($criteria, $orderBy, $limit, $offset);
	}
	
	
	/**
	 * Create user
	 * 
	 * @param UserEntity $userEntity
	 * @return UserEntity
	 * @throws RepositoryException
	 */
	public function create($userEntity)
	{
		$this->emailExists($userEntity->email);

		$create = $this->entityManager->persist($userEntity);

		$this->entityManager->persist($userEntity->info);

		if (!$create) {
			throw new RepositoryException(_('Could not create the user.'));
		}
		
		return $userEntity;
	}
	
	
	/**
	 * Update user
	 * 
	 * @param UserEntity $userEntity
	 * @return UserEntity
	 */
	public function update($userEntity)
	{
		$this->emailExists($userEntity->email, null, $userEntity->id);
		
		return $userEntity;
	}
	
	
	/**
	 * Delete user by criteria
	 * 
	 * @param array $criteria
	 * @param int $status
	 */
	public function delete($criteria = [], $status = self::STATUS_BLOCKED)
	{
		$userEntity = $this->userEntity->findOneBy($criteria);
		$userEntity->status = $status;
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
				throw new RepositoryException(_('Passwords must be the same.'));
			}
		} else {
			$password = Strings::random();
		}

		return $password;
	}
	
	
	/**
	 * Generate token
	 * 
	 * @param int $length
	 * @return string
	 */
	public function generateToken($length = 10)
	{
		return Random::generate($length);
	}
	
	
	/**
	 * Check email is exists
	 * 
	 * @param string $email
	 * @param mixed $role
	 * @param mixed $without without user ids
	 * @return mixed
	 */
	public function emailExists($email, $role = null, $without = null)
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
			
			$by['id != ?'] = $without;
		}
		
		$check = $this->userEntity->countBy($by);
		
		if ($check == 0) {
			return null;
		} else {
			throw new RepositoryException(_('The user with this email already exists.'));
		}
	}
	
}