<?php

namespace Wame\UserModule\Forms;

use Wame\Core\Forms\FormFactory;

class SignUpForm extends FormFactory
{	
	public function create()
	{
		$form = $this->createForm();
				
		return $form;
	}

}
