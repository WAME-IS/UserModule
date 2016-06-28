<?php

namespace Wame\UserModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\UserModule\Entities\CompanyEntity;

class CompanyRepository extends BaseRepository
{
	const STATUS_REMOVED = 0;
	const STATUS_ACTIVE = 1;
	
	
	public function __construct(
		\Nette\DI\Container $container, 
		\Kdyby\Doctrine\EntityManager $entityManager, 
		\h4kuna\Gettext\GettextSetup $translator, 
		\Nette\Security\User $user
	) {
		parent::__construct($container, $entityManager, $translator, $user, CompanyEntity::class);
	}

	
	/**
	 * Create company
	 * 
	 * @param CompanyEntity $companyEntity
	 * @return CompanyEntity
	 */
	public function create($companyEntity)
	{
		$this->entityManager->persist($companyEntity);
		
		return $companyEntity;
	}

	
	/**
	 * Update company
	 * 
	 * @param CompanyEntity $companyEntity
	 * @return CompanyEntity
	 */
	public function update($companyEntity)
	{
		return $companyEntity;
	}
	
}