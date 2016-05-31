<?php

namespace Wame\UserModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;

interface INickFormContainerFactory
{
	/** @return NickFormContainer */
	public function create();
}


class NickFormContainer extends BaseFormContainer
{	
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

//		$form->addGroup(_('Login data'));

		$form->addText('nick', _('Nick'))
				->setRequired(_('Please enter nick'));
    }
	
	
	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$form['nick']->setDefaultValue($object->userEntity->nick);
	}
	
}