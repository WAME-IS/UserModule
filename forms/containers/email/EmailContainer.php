<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;

interface IEmailContainerFactory extends IBaseContainer
{
	/** @return EmailContainer */
	public function create();
}

class EmailContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure() 
	{
		$this->addText('email', _('Email'));
    }

    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['email']->setDefaultValue($entity->getEmail());
	}

    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setEmail($values['email']);
    }

    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setEmail($values['email']);
    }

}