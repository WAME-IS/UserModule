<?php

namespace Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuManager\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;

interface ISignInFormContainerFactory
{
	/** @return SignInFormContainer */
	public function create();
}


class SignInFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('title', _('Title'))
				->setDefaultValue(_('Sign in'));
    }
	
	
	public function setDefaultValues($object)
	{
		$form = $this->getForm();

		$form['title']->setDefaultValue($object->menuEntity->langs[$object->lang]->title);
	}

}