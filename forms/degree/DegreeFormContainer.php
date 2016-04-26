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
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function configure() 
	{
		$form = $this->getForm();
		
		$form->addGroup(_('Contact details'));

		$form->addText('degree', _('Degree'));
    }
	
}