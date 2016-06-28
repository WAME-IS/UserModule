<?php

namespace Wame\UserModule\Forms\Company;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;


interface IDescriptionFormContainerFactory
{
	/** @return DescriptionFormContainer */
	public function create();
}


class DescriptionFormContainer extends BaseFormContainer
{
    public function attached($object) 
	{
        parent::attached($object);

        if ($object instanceof Form) {
            $object->onSuccess[] = function (Form $form) 
			{
				if ($form->parent->id) {
					$description = $form->getValues()->description;
				
					$form->parent->companyEntity->setDescription($description);
				}
				
				return $form;
            };
        }
    }


    public function configure() 
	{
		$form = $this->getForm();

		$form->addTextArea('description', _('Description'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$form['description']->setDefaultValue($object->companyEntity->getDescription());
	}

}