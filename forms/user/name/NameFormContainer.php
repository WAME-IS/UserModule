<?php

namespace Wame\UserModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\UserModule\Entities\UserInfoEntity;


interface INameFormContainerFactory
{
	/** @return NameFormContainer */
	public function create();
}


class NameFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('first_name', _('First name'))
				->setRequired(_('Please enter first name'));
		
		$form->addText('last_name', _('Last name'))
				->setRequired(_('Please enter last name'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$form['first_name']->setDefaultValue($object->userEntity->info->firstName);
		$form['last_name']->setDefaultValue($object->userEntity->info->lastName);
	}


    /**
     * Create
     * 
     * @param \Nette\Application\UI\Form $form
     * @param array $values
     * @param \Nette\Application\UI\Presenter $presenter
     */
    public function create($form, $values, $presenter)
    {
        $userInfoEntity = $presenter->getStatus()->get('userInfoEntity');

        if (!$userInfoEntity) {
            $userInfoEntity = new UserInfoEntity();
        }

        $userInfoEntity->setFirstName($values['first_name']);
        $userInfoEntity->setLastName($values['last_name']);

        $presenter->getStatus()->set('userInfoEntity', $userInfoEntity);
    }

}