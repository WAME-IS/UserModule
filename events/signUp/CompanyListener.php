<?php

namespace Wame\UserModule\Events\SignUp;

use Nette\Object;
use Wame\Utils\Strings;
use Wame\UserModule\Entities\CompanyEntity;
use Wame\UserModule\Repositories\CompanyRepository;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserInCompanyEntity;
use Wame\UserModule\Repositories\UserInCompanyRepository;

class CompanyListener extends Object
{
	/** @var CompanyRepository */
	private $companyRepository;
	
	/** @var UserInCompanyRepository */
	private $userInCompanyRepository;

	
	public function __construct(
		CompanyRepository $companyRepository, 
		UserRepository $userRepository,
		UserInCompanyRepository $userInCompanyRepository
	) {
		$this->companyRepository = $companyRepository;
		$this->userInCompanyRepository = $userInCompanyRepository;
		
		$userRepository->onCreate[] = [$this, 'onCreate'];
	}
	

	public function onCreate($form, $values, $userEntity) 
	{
		$companyEntity = new CompanyEntity();
		$companyEntity->setName($userEntity->getFullName());
		$companyEntity->setSlug(Strings::webalize($userEntity->getFullName()));
		$companyEntity->setStatus(CompanyRepository::STATUS_ACTIVE);
		$companyEntity->setToken(time());
		$companyEntity->setCreateDate($userEntity->getRegisterDate());
		$companyEntity->setCreateUser($userEntity);
		
		$this->companyRepository->create($companyEntity);

		$userInCompanyEntity = new UserInCompanyEntity();
		$userInCompanyEntity->setCompany($companyEntity);
		$userInCompanyEntity->setUser($userEntity);
		$userInCompanyEntity->setCreateDate($userEntity->getRegisterDate());
		
		$this->userInCompanyRepository->create($userInCompanyEntity);
	}

}
