<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;

interface IIcDphContainerFactory extends IBaseContainer
{
	/** @return IcDphContainer */
	public function create();
}

class IcDphContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure() 
	{
		$this->addText('icDph', _('VAT reg. no.'));
    }

    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['icDph']->setDefaultValue($entity->getIcDph());
	}

    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setIcDph($values['icDph']);
    }

    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setIcDph($values['icDph']);
    }

}