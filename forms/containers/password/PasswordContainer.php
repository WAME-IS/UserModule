<?php

namespace Wame\UserModule\Forms\Containers;

use Nette\Security\Passwords;
use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;


interface IPasswordContainerFactory extends IBaseContainer
{
	/** @return PasswordContainer */
	public function create();
}


class PasswordContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
	{
		$this->addPassword('password', _('Password'))
            ->setType('password')
            ->setRequired(true);
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setPassword($values['password']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setPassword($values['password']);
    }

}
