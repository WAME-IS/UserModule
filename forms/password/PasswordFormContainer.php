<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;

class PasswordFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function configure() 
	{
		$form = $this->getForm();

		$form->addPassword('password', _('Password'))
				->setType('password')
				->setRequired(_('Please enter password'))
				->addRule(Form::FILLED, _('Password can not be empty'));
    }
	
}