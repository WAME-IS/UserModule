<?php

namespace Wame\UserModule\Repositories;

use Doctrine\ORM\AbstractQuery;
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
     *
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
     *
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
     *
     * @param int $status
     */
    public function changeStatus($criteria = [], $status = self::STATUS_REMOVED)
    {
        $entity = $this->get($criteria);
        $entity->status = $status;
    }


    /**
     * Get company list
     * sorted by value ASC
     *
     * @param string $value value and sort
     *
     * @return array
     */
    public function getPairs($value = 'name')
    {
        return $this->findPairs([], $value, [$value => 'ASC']);
    }


    /** api ************************************************************/

    /**
     * @api {get} /company-search/ Search company
     * @param array $columns
     * @param string $phrase
     * @param string $select
     * @return array
     */
    public function findLike($columns = [], $phrase = null, $select = '*')
    {
        $search = $this->entityManager->createQueryBuilder()
            ->select($select)
            ->from(CompanyEntity::class, 'a')
            ->andWhere('a.status = :status')
            ->setParameter('status', self::STATUS_ACTIVE);

        foreach ($columns as $column) {
            $search->andWhere($column . ' LIKE :phrase');
        }

        $search->setParameter('phrase', '%' . $phrase . '%');

        return $search->getQuery()->getResult(AbstractQuery::HYDRATE_ARRAY);
    }

}
