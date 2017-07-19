<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;


interface IDegreeContainerFactory extends IBaseContainer
{
	/** @return DegreeContainer */
	public function create();
}


class DegreeContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
	{
		$this->addText('degree', _('Degree'));
    }


    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['degree']->setDefaultValue($entity->getDegree());
	}


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setDegree($values['degree']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setDegree($values['degree']);
    }

}
