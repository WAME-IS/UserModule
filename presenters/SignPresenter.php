<?php

namespace App\UserModule\Presenters;

use Wame\DynamicObject\Forms\EntityForm;
use Wame\UserModule\Repositories\UserRepository;


class SignPresenter extends \App\Core\Presenters\BasePresenter
{
    /** @var UserRepository @inject */
    public $userRepository;

    
    /** actions ***************************************************************/
	
	public function actionIn()
	{
		if ($this->user->isLoggedIn()) {
			$this->flashMessage(_('You are now logged.'), 'info');
			$this->redirect(':User:Profile:');
		}
	}
	
	
	public function actionUp()
	{
		if ($this->user->isLoggedIn()) {
			$this->flashMessage(_('You are now logged.'), 'info');
			$this->redirect(':User:Profile:');
		}
	}
	
	
	public function actionOut()
	{
		$this->getUser()->logout(true);
		$this->redirect(':User:Sign:in');
	}
    
    
    /** renders ***************************************************************/
	
	public function renderIn()
	{
		$this->template->siteTitle = _('Login');
	}
	
	
	public function renderUp()
	{
		$this->template->siteTitle = _('Registration');
	}
	
	
    /** components ************************************************************/
    
	/**
	 * Sign in form
	 * 
	 * @return EntityForm
	 */
	protected function createComponentSignInForm()
	{
        return $this->context
                    ->getService('UserSignInFormBuilder')
                    ->build();
	}
	
	
	/**
	 * Sign up form
	 * 
	 * @return EntityForm
	 */
	protected function createComponentSignUpForm()
	{
        return $this->context
                    ->getService('UserSignUpFormBuilder')
                    ->build();
	}

}
