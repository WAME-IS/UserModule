<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\UserModule\Repositories\UserInCompanyRepository;
use Nette\Security\User;

interface ICompanyContainerFactory extends IBaseContainer
{
	/** @return CompanyContainer */
	public function create();
}

class CompanyContainer extends BaseContainer
{
    /** @var string */
    private $companyList;


    public function __construct(\Nette\DI\Container $container, UserInCompanyRepository $userInCompanyRepository, User $user)
    {
        parent::__construct($container);

        $this->companyList = $userInCompanyRepository->getCompanyList($user->id);
    }


    /** {@inheritDoc} */
    public function configure()
	{
        $count = count($this->companyList);

        if($count > 1) {
            $this->addSelect('company', _('Company'), \Wame\Utils\Arrays::getPairs($this->companyList, 'id', 'name'))
                ->setPrompt(_('-- Select Company --'));
        } else if ($count == 1) {
            $this->addHidden('company')
                    ->setValue(array_keys($this->companyList)[0]);
        }
    }

    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['company']->setDefaultValue($entity->getCompany()->id);
	}

    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setCompany($this->companyList[$values['company']]);
    }

    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setCompany($this->companyList[$values['company']]);
    }

}