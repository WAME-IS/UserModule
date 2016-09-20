<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;

interface IIcoContainerFactory extends IBaseContainer
{
	/** @return IcoContainer */
	public function create();
}

class IcoContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure() 
	{
		$this->addText('ico', _('Ico'))
				->setRequired(_('Please enter ICO'));
    }

    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['ico']->setDefaultValue($entity->getIco());
	}

    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setIco($values['ico']);
    }

    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setIco($values['ico']);
    }

}