<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Forms;

use Wame\Core\Forms\FormFactory;

class CreateUserForm extends FormFactory
{	
	public function create()
	{
		$form = $this->createForm();
		
		$form->addSubmit('submit', _('Create user'));

		return $form;
	}

}
