<?php

namespace Wame\UserModule\Components;

use Wame\Core\Components\BaseControl;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\UserInCompanyRepository;
use Wame\UserModule\Components\ICompanyControlFactory;


interface ICompanyListControlFactory
{
    /** @return CompanyListControl */
    public function create();
}


class CompanyListControl extends BaseControl
{
    /** @var UserInCompanyRepository */
    private $userInCompanyRepository;


    public function __construct(
        \Nette\DI\Container $container,
        UserInCompanyRepository $userInCompanyRepository,
        ICompanyControlFactory $ICompanyControlFactory
    ) {
        parent::__construct($container);

        $this->userInCompanyRepository = $userInCompanyRepository;

        $this->addComponent($ICompanyControlFactory->create(), 'company');
    }


    public function render($userEntity)
    {
        if (!$userEntity) {
            $userEntity = $this->getStatus()->get(UserEntity::class);
        }

		$companyList = $this->userInCompanyRepository->getCompanyList($userEntity->getId());

        $this->template->companyList = $companyList;
    }

}
