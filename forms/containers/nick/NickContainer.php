<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;

interface INickContainerFactory extends IBaseContainer
{
	/** @return NickContainer */
	public function create();
}

class NickContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure() 
	{
		$this->addText('nick', _('Nick'));
    }

    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['nick']->setDefaultValue($entity->getNick());
	}

    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setNick($values['nick']);
    }

    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setNick($values['nick']);
    }

}