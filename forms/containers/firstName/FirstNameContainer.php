<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;


interface IFirstNameContainerFactory extends IBaseContainer
{
	/** @return FirstNameContainer */
	public function create();
}


class FirstNameContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
	{
		$this->addText('firstName', _('First name'));
    }


    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['firstName']->setDefaultValue($entity->getFirstName());
	}


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setFirstName($values['firstName']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setFirstName($values['firstName']);
    }

}
