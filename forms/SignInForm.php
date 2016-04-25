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
		$this->user = $user;
		
		$this->loginExpiration = $container->parameters['user']['loginExpiration'];
	}
	
	/**
	 * @return Form
	 */
	public function create()
	{
		$form = $this->createForm();
		
		$form->addText('email', _('Email'))
				->setRequired(_('Please enter your login email.'));

		$form->addPassword('password', _('Password'))
				->setRequired(_('Please enter your password.'));

		$form->addCheckbox('remember', _('Keep me signed in'));

		$form->addSubmit('send', _('Sign in'));

		$form->onSuccess[] = [$this, 'formSucceeded'];
		
		return $form;
	}

	/**
	 * Sign in user
	 * 
	 * @param Form $form
	 * @param array $values
	 */
	public function formSucceeded(Form $form, $values)
	{
		if ($values->remember) {
			$this->user->setExpiration($this->loginExpiration['remember'], FALSE);
		} else {
			$this->user->setExpiration($this->loginExpiration['forget'], TRUE);
		}

		try {
			$this->user->login($values->email, $values->password);
		} catch (Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
