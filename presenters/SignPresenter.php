<?php

namespace App\UserModule\Presenters;

use Wame\UserModule\Forms\SignInForm;

class SignPresenter extends \App\Core\Presenters\BasePresenter
{	
	/** @var SignInForm @inject */
	public $signInForm;

	/**
	 * Sign in form factory
	 * 
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->signInForm->create();

		$form->addComponent(new \Nette\Forms\Controls\TextInput('Nick'), 'nick', 'password');
		
		$form['nick']->setAttribute('placeholder', 'nick');
		
		return $form;
	}
	
	public function actionIn()
	{
		if ($this->user->isLoggedIn()) {
			$this->flashMessage('Momentálne ste prihlásený.', 'info');
			$this->redirect(':Homepage:Homepage:');
		}
	}
	
	public function actionOut()
	{
		$this->getUser()->logout(true);
		$this->redirect(':Homepage:Homepage:');
	}
	
	public function renderIn()
	{
		$this->template->siteTitle = _('Prihlásenie');
	}

}
