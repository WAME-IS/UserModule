<?php

namespace Wame\UserModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;

interface IBirthdateFormContainerFactory
{
	/** @return BirthdateFormContainer */
	public function create();	
}


class BirthdateFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();
		
		$form->addGroup(_('Other details'));

		$form->addText('birthdate', _('Birthdate'));
    }
	
	
	public function setDefaultValues($object)
	{
		$form = $this->getForm();

		if ($object->userEntity->info->birthdate) {
			$form['birthdate']->setDefaultValue($this->formatDate($object->userEntity->info->birthdate, 'd.m.Y'));
		}
	}
	
}