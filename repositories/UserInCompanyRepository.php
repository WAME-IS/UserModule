<?php

namespace Wame\UserModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\UserModule\Entities\UserInCompanyEntity;

class UserInCompanyRepository extends BaseRepository
{
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

}