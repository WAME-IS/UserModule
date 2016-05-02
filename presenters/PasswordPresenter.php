<?php

namespace App\UserModule\Presenters;

use Wame\UserModule\Forms\PasswordForgotForm;
use Wame\UserModule\Forms\PasswordNewForm;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserEntity;

class PasswordPresenter extends \App\Core\Presenters\BasePresenter
{
	/** @var PasswordForgotForm @inject */
	public $passwordForgotForm;
	
	/** @var PasswordNewForm @inject */
	public $passwordNewForm;
	
	/** @var UserRepository @inject */
	public $userRepository;
	
	/** @var UserEntity */
	private $userEntity;
	

	public function actionIn()
	{
		if ($this->user->isLoggedIn()) {
			$this->flashMessage(_('You are now logged.'), 'info');
			$this->redirect(':User:Profile:', ['id' => null]);
		}
	}
	

	public function actionNew()
	{
		if ($this->user->isLoggedIn()) {
			$this->flashMessage(_('You are now logged.'), 'info');
			$this->redirect(':User:Profile:', ['id' => null]);
		}
		
		if (!$this->id) {
			$this->flashMessage(_('Missing user identifier.'), 'danger');
			$this->redirect(':User:Sign:in', ['id' => null]);
		}
		
		$this->userEntity = $this->userRepository->get(['token' => $this->id]);
		
		if (!$this->userEntity) {
			$this->flashMessage(_('The user of this identifier not found.'), 'danger');
			$this->redirect(':User:Sign:in', ['id' => null]);
		}
		
		if ($this->userEntity->status == UserRepository::STATUS_BLOCKED) {
			$this->flashMessage(_('This user account is blocked.'), 'danger');
			$this->redirect(':User:Sign:in', ['id' => null]);
		}
	}

	
	/**
	 * Forgotten password form
	 * 
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentPasswordForgotForm()
	{
		$form = $this->passwordForgotForm->build();
		
		return $form;
	}

	
	/**
	 * New password form
	 * 
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentPasswordNewForm()
	{
		$form = $this->passwordNewForm->setUserEntity($this->userEntity)->build();
		
		return $form;
	}
	
	
	public function renderForgot()
	{
		$this->template->siteTitle = _('Reset password');
	}
	
	
	public function renderNew()
	{
		$this->template->siteTitle = _('Enter a new password');
	}

}
