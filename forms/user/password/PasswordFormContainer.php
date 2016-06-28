<?php

namespace Wame\UserModule\Forms;

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
				->setType('password')
				->setRequired(_('Please enter password'))
				->addRule(Form::FILLED, _('Password can not be empty'));
    }

}