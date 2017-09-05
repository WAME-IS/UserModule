<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;

interface IDicContainerFactory extends IBaseContainer
{
	/** @return DicContainer */
	public function create();
}

class DicContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure() 
	{
		$this->addText('dic', _('Tax ID'));
    }

    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['dic']->setDefaultValue($entity->getDic());
	}

    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setDic($values['dic']);
    }

    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setDic($values['dic']);
    }

}