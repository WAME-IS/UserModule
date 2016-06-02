<?php

namespace Wame\UserModule\Forms\Company;

use Nette\Application\UI\Form;
use Nette\Utils\Strings;
use Wame\DynamicObject\Forms\BaseFormContainer;


interface INameFormContainerFactory
{
	/** @return NameFormContainer */
	public function create();
}


class NameFormContainer extends BaseFormContainer
{
    public function attached($object) 
	{
        parent::attached($object);

        if ($object instanceof Form) {
			$object->onSuccess[] = function (Form $form) 
			{
				if ($form->parent->id) {
					$name = $form->getValues()->name;

					$form->parent->companyEntity->setName($name);
					$form->parent->companyEntity->setSlug(Strings::webalize($name));
				}
				
				return $form;
            };
        }
    }
	

    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('name', _('Name'))
				->setType('text')
				->setRequired(_('Please enter name'))
				->addRule(Form::FILLED, _('Name can not be empty'));
    }
	
	
	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$form['name']->setDefaultValue($object->companyEntity->getName());
	}

}