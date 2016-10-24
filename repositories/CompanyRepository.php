<?php

namespace Wame\UserModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\UserModule\Entities\CompanyEntity;

class CompanyRepository extends BaseRepository
{
	const STATUS_REMOVED = 0;
	const STATUS_ACTIVE = 1;


	public function __construct()
    {
		parent::__construct(CompanyEntity::class);
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


    /**
     * Change status
     *
     * @param array $criteria
     * @param int $status
     */
    public function changeStatus($criteria = [], $status = self::STATUS_REMOVED)
    {
        $entity = $this->get($criteria);
        $entity->status = $status;
    }

}