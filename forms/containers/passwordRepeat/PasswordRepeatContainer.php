<?php

namespace Wame\UserModule\Forms\Containers;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;


interface IPasswordRepeatContainerFactory extends IBaseContainer
{
	/** @return PasswordRepeatContainer */
	public function create();
}


class PasswordRepeatContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
	{
		$this->addPassword('passwordRepeat', _('Password repeat'))
                ->setRequired(true)
                ->addRule(Form::FILLED, _('Password can not be empty'))
                ->addRule(Form::EQUAL, _('Passwords must be the same'), $this->getForm()['PasswordContainer']['password']);
    }

}
