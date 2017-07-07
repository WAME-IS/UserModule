<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;


interface ILastNameContainerFactory extends IBaseContainer
{
	/** @return LastNameContainer */
	public function create();
}


class LastNameContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
	{
		$this->addText('lastName', _('Last name'));
    }


    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['lastName']->setDefaultValue($entity->getLastName());
	}


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setLastName($values['lastName']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setLastName($values['lastName']);
    }

}
