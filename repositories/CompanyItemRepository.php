<?php

namespace Wame\UserModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\UserModule\Entities\CompanyItemEntity;


class CompanyItemRepository extends BaseRepository
{
	public function __construct()
    {
		parent::__construct(CompanyItemEntity::class);
	}


	/**
	 * Create company item
	 *
	 * @param CompanyItemEntity $companyItemEntity
	 * @return CompanyItemEntity
	 */
	public function create($companyItemEntity)
	{
		$this->entityManager->persist($companyItemEntity);

		return $companyItemEntity;
	}

}
