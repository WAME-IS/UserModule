<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;

interface IBirthdateContainerFactory extends IBaseContainer
{
	/** @return BirthdateContainer */
	public function create();
}

class BirthdateContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure() 
	{
		$this->addText('birthdate', _('Birthdate'));
    }

    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['birthdate']->setDefaultValue($entity->getBirthdate());
	}

    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setBirthdate($values['birthdate']);
    }

    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setBirthdate($values['birthdate']);
    }

}