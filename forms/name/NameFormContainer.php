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
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('first_name', _('First name'))
				->setRequired(_('Please enter first name'));
		
		$form->addText('last_name', _('Last name'))
				->setRequired(_('Please enter last name'));
    }
	
}