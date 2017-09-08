<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\Core\Registers\RepositoryRegister;
use Wame\Core\Registers\StatusTypeRegister;
use Wame\Core\Registers\Types\StatusType;
use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\UserModule\Entities\CompanyItemEntity;
use Wame\UserModule\Registers\CompanyItemRegister;
use Wame\UserModule\Repositories\CompanyItemRepository;
use Wame\UserModule\Repositories\CompanyRepository;
use Wame\UserModule\Repositories\UserInCompanyRepository;
use Nette\Security\User;


interface ICompanyItemContainerFactory extends IBaseContainer
{
	/** @return CompanyItemContainer */
	public function create();
}


class CompanyItemContainer extends BaseContainer
{
    /** @var CompanyRepository */
    private $companyRepository;

    /** @var CompanyItemRepository */
    private $companyItemRepository;

    /** @var CompanyItemRegister */
    private $companyItemRegister;

    /** @var StatusTypeRegister */
    private $statusTypeRegister;

    /** @var array */
    private $companyList;


    public function __construct(
        \Nette\DI\Container $container,
        CompanyRepository $companyRepository,
        CompanyItemRepository $companyItemRepository,
        CompanyItemRegister $companyItemRegister,
        StatusTypeRegister $statusTypeRegister
    ) {
        parent::__construct($container);

        $this->companyRepository = $companyRepository;
        $this->companyItemRepository = $companyItemRepository;
        $this->companyItemRegister = $companyItemRegister;
        $this->statusTypeRegister = $statusTypeRegister;

        $this->companyList = $companyRepository->getPairs();
    }


    /** {@inheritDoc} */
    public function configure()
	{
        $count = count($this->companyList);

        if ($count > 1) {
            $this->addAutocomplete('company', _('Company'))
                    ->setAttribute('placeholder', _('Begin typing the company name'))
                    ->setSource('/api/v1/company-search')
                    ->setColumns(['a.name'])
                    ->setSelect('a.id, a.name')
                    ->setFieldValue('id')
                    ->setFieldLabel('name')
                    ->setFieldSearch('name');
//                    ->setRequired(_('You must select company'));

//            $this->addSelect('company', _('Company'), $this->companyList)
//                    ->setPrompt('- ' . _('Select Company') . ' -');
        } else if ($count == 1) {
            $this->addHidden('company')
                    ->setValue(array_keys($this->companyList)[0]);
        }
    }


    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $type = $this->statusTypeRegister->getByEntityClass(get_class($entity))->getAlias();
	    $item = $this->companyItemRepository->get(['type' => $type, 'valueId' => $entity->getId()]);

	    if ($item) {
            $this['company']
                ->setDefaultValue($item->getCompany()->getId())
                ->setDefaultLabel($item->getCompany()->getName());
        }
	}


    /** {@inheritDoc} */
    public function postUpdate($form, $values)
    {
        $entity = $form->getEntity();
        $valueId = $entity->getId();
        $type = $this->statusTypeRegister->getByEntityClass(get_class($entity))->getAlias();
        $companyId = $values['company'];

        if ($companyId == '') {
            $this->companyItemRepository->remove(['type' => $type, 'valueId' => $valueId]);

            return $this;
        }

        $find = $this->companyItemRepository->get(['type' => $type, 'valueId' => $valueId]);

        if ($find) {
            if ($find->getCompany()->getId() == $companyId) return $this;

            $company = $this->companyRepository->get(['id' => $companyId]);

            $find->setCompany($company);
        } else {
            $company = $this->companyRepository->get(['id' => $companyId]);

            $entity = new CompanyItemEntity();
            $entity->setType($type);
            $entity->setCompany($company);
            $entity->setValueId($valueId);

            $this->companyItemRepository->create($entity);
        }
    }

}
