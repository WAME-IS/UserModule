<?php

namespace Wame\UserModule\Forms\Settings;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;


interface IPasswordFormContainerFactory
{
	/** @return PasswordFormContainer */
	public function create();
}


class PasswordFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();
        
		$form->addPassword('password', _('Password'))
				->setType('password');
        
        $form->addPassword('password_repeat', _('Password repeat'))
				->setType('password')
				->addRule(Form::EQUAL, _('Passwords must be the same'), $form['password']);
    }

}