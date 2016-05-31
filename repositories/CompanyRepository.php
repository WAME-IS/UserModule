<?php

namespace Wame\UserModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\UserModule\Entities\CompanyEntity;

class CompanyRepository extends BaseRepository
{
	const STATUS_REMOVED = 0;
	const STATUS_ACTIVE = 1;

	
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
	
}