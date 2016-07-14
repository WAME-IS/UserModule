<?php

namespace Wame\UserModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;


interface ITextFormContainerFactory
{
	/** @return TextFormContainer */
	public function create();
}


class TextFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();
		
		$form->addTextArea('text', _('About me'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();

		$form['text']->setDefaultValue($object->userEntity->info->text);
	}

}