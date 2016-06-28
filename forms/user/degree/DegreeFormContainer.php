<?php

namespace Wame\UserModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;


interface IDegreeFormContainerFactory
{
	/** @return DegreeFormContainer */
	public function create();
}


class DegreeFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();
		
		$form->addGroup(_('Contact details'));

		$form->addText('degree', _('Degree'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();

		$form['degree']->setDefaultValue($object->userEntity->info->degree);
	}

}