<?php

namespace Wame\UserModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\UserModule\Entities\UserInCompanyEntity;

class UserInCompanyRepository extends BaseRepository
{
	public function __construct(
		\Nette\DI\Container $container, 
		\Kdyby\Doctrine\EntityManager $entityManager, 
		\h4kuna\Gettext\GettextSetup $translator, 
		\Nette\Security\User $user
	) {
		parent::__construct($container, $entityManager, $translator, $user, UserInCompanyEntity::class);
	}
	
	
	/**
	 * Add user to company
	 * 
	 * @param UserInCompanyEntity $userInCompanyEntity
	 * @return UserInCompanyEntity
	 */
	public function create($userInCompanyEntity)
	{
		$this->entityManager->persist($userInCompanyEntity);
		
		return $userInCompanyEntity;
	}
	
	
	/**
	 * Get company list
	 * 
	 * @param int $userId
	 * @return array
	 * @throws \Exception
	 */
	public function getCompanyList($userId = null)
	{
		if (!$userId) {
			$userId = $this->user->id;
		}
		
		$find = $this->find(['user.id' => $userId, 'company.status' => CompanyRepository::STATUS_ACTIVE]);

		$return = [];
		
		foreach ($find as $row) {
			$return[$row->company->getId()] = $row->company;
		}

		return $return;
	}
	
	
	/**
	 * Get company pairs
	 * 
	 * @param int $userId
	 * @return array
	 */
	public function getCompanyPairs($userId = null, $value = 'name', $key = 'id')
	{
		$return = [];
		
		$companies = $this->getCompanyList($userId);
		
		foreach ($companies as $company) {
			$return[$company->$key] = $company->$value;
		}
		
		return $return;
	}

}