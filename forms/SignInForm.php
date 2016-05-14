<?php

namespace Wame\UserModule\Forms;

use Nette\DI\Container;
use Nette\Security;
use Nette\Application\UI\Form;
use Wame\Core\Forms\FormFactory;

class SignInForm extends FormFactory
{
	/** @var Security\User */
	private $user;

	/** @var array */
	private $loginExpiration;

	
	public function __construct(
		Container $container,
		Security\User $user
	) {
		parent::__construct();

		$this->user = $user;
		
		$this->loginExpiration = $container->parameters['user']['loginExpiration'];
	}

	
	public function build()
	{
		$form = $this->createForm();

		$form->addCheckbox('remember', _('Keep me signed in'));

		$form->addSubmit('submit', _('Sign in'));

		$form->onSuccess[] = [$this, 'formSucceeded'];
		
		return $form;
	}

	public function formSucceeded(Form $form, $values)
	{
		if ($values['remember']) {
			$this->user->setExpiration($this->loginExpiration['remember'], FALSE);
		} else {
			$this->user->setExpiration($this->loginExpiration['forget'], TRUE);
		}

		try {
			$this->user->login($values['email'], $values['password']);
		} catch (Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
