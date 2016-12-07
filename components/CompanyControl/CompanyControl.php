<?php

namespace Wame\UserModule\Components;

use Wame\Core\Components\BaseControl;
use Wame\UserModule\Entities\CompanyEntity;
use Wame\LocationModule\Entities\AddressEntity;
use Wame\LocationModule\Components\IAddressControlFactory;


interface ICompanyControlFactory
{
    /** @return CompanyControl */
    public function create();
}


class CompanyControl extends BaseControl
{
    public function __construct(
        \Nette\DI\Container $container,
        IAddressControlFactory $IAddressControlFactory
    ) {
        parent::__construct($container);

        $this->addComponent($IAddressControlFactory->create(), 'address');
    }


    public function render($companyEntity)
    {
        if (!$companyEntity) {
            $companyEntity = $this->getStatus()->get(CompanyEntity::class);
        }

        $this->getStatus()->set(CompanyEntity::class, $companyEntity);
        $this->getStatus()->set(AddressEntity::class, $companyEntity->getAddress());

        $this->template->company = $companyEntity;
    }

}
