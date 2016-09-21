<?php

namespace Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuManager\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;


interface ISignUpFormContainerFactory
{
	/** @return SignUpFormContainer */
	public function create();
}


class SignUpFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('title', _('Title'))
				->setDefaultValue(_('Sign up'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();

		$form['title']->setDefaultValue($object->menuEntity->langs[$object->lang]->title);
	}

}