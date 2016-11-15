<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;


interface IPasswordRepeatFormContainerFactory
{
	/** @return PasswordRepeatFormContainer */
	public function create();
}


class PasswordRepeatFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();
		
		$form->addPassword('password_repeat', _('Password repeat'))
				->setType('password')
                ->setRequired(true)
				->addRule(Form::FILLED, _('Password can not be empty'))
				->addRule(Form::EQUAL, _('Passwords must be the same'), $form['password']);
    }

}