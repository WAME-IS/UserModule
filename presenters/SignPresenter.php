<?php

namespace App\UserModule\Presenters;

use Wame\DynamicObject\Forms\EntityForm;
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
    
    
    public function actionVerify()
    {
        $error = false;
        $email = $this->getParameter('email');
        $hash = $this->getParameter('hash');
        
        $user = $this->userRepository->get(['token' => $hash, 'email' => $email, 'status' => UserRepository::STATUS_VERIFY_EMAIL]);
        
        if($email & $hash) {
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
            $this->userRepository->onConfirm($user);
        } else {
            $this->flashMessage(_('Invalid approach, please use the link that has been send to your email.'), 'danger');
        }
        
        $this->redirect(':User:Profile:');
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
    
    public function renderPolicies()
    {
        $this->template->siteTitle = _('Policies');
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
            ->build($this->id);
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
            ->build($this->id);
	}
	
    

}
