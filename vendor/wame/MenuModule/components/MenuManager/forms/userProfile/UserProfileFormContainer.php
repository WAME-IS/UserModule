<?php

namespace Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuManager\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;

interface IUserProfileFormContainerFactory
{
	/** @return UserProfileFormContainer */
	public function create();
}


class UserProfileFormContainer extends BaseFormContainer
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
				->setDefaultValue(_('Profile'));
    }
	
	
	public function setDefaultValues($object)
	{
		$form = $this->getForm();

		$form['title']->setDefaultValue($object->menuEntity->langs[$object->lang]->title);
	}

}