<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\Utils\Date;
use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\UserModule\Repositories\UserRepository;


interface IGenderContainerFactory extends IBaseContainer
{
	/** @return GenderContainer */
	public function create();
}


class GenderContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
	{
		$this->addRadioList('gender', _('Gender'), UserRepository::getGender())
                ->setRequired(true)
                ->getSeparatorPrototype()->setName(null);
    }


    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['gender']->setDefaultValue($entity->getGender());
	}


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setGender($values['gender']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setGender($values['gender']);
    }

}
