<?php

namespace Wame\UserModule\Forms\Containers;

use Nette\Application\UI\Form;
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
	    $minLength = 8;
	    $condition = _('Password must contain at least one number, uppercase and lowercase letter');

		$this->addPassword('password', _('Password'))
                ->setOption('description', sprintf(_('Password must be at least %s characters long and must contain at least one number, uppercase and lowercase letter.'), $minLength))
                ->setRequired(true)
                ->addRule(Form::MIN_LENGTH, _('Password must be at least %d characters long'), $minLength)
                ->addRule(Form::PATTERN, $condition, '.*[0-9].*')
                ->addRule(Form::PATTERN, $condition, '.*[A-Z].*')
                ->addRule(Form::PATTERN, $condition, '.*[a-z].*');
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
