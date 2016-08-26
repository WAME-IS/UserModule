<?php

namespace App\UserModule\Presenters;

use Wame\UserModule\Forms\SignInForm;
use Wame\UserModule\Forms\SignUpForm;
use Wame\UserModule\Repositories\UserRepository;

class SignPresenter extends \App\Core\Presenters\BasePresenter
{	
	/** @var SignInForm @inject */
	public $signInForm;

	/** @var SignUpForm @inject */
	public $signUpForm;
    
    /** @var UserRepository @inject */
    public $userRepository;
	
	
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
    
    
    public function actionVerify()
    {
        $error = false;
        $email = $this->getParameter('email');
        $hash = $this->getParameter('hash');
        
        if($email & $hash) {
            $user = $this->userRepository->get(['token' => $hash, 'email' => $email, 'status' => UserRepository::STATUS_VERIFY_EMAIL]);
            
            if($user) {
                $user->status = UserRepository::STATUS_ACTIVE;
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }
        
        if(!$error) {
            $this->flashMessage(_('Your account has been activated.'), 'info');
        } else {
            $this->flashMessage(_('Invalid approach, please use the link that has been send to your email.'), 'danger');
        }
        
        $this->redirect(':User:Profile:');
    }
	
	
	/**
	 * Sign in form
	 * 
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->signInForm->build();
		
		return $form;
	}
	
	
	/**
	 * Sign up form
	 * 
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignUpForm()
	{
		$form = $this->signUpForm->build();
		
		return $form;
	}
	
	
	public function renderIn()
	{
		$this->template->siteTitle = _('Login');
	}
	
	
	public function renderUp()
	{
		$this->template->siteTitle = _('Registration');
	}

}
