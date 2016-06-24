<?php

namespace Wame\UserModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;


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

}