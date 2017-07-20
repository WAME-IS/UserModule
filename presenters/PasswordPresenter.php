<?php

namespace App\UserModule\Presenters;

use Wame\DynamicObject\Forms\BaseForm;
use Wame\UserModule\Repositories\TokenRepository;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserEntity;


class PasswordPresenter extends \App\Core\Presenters\BasePresenter
{
    /** @var TokenRepository @inject */
    public $tokenRepository;

    /** @var UserRepository @inject */
    public $userRepository;
	
	/** @var UserEntity */
	private $userEntity;


    /** actions ***************************************************************/

    public function actionChange()
    {
        if (!$this->user->isLoggedIn()) {
            $this->flashMessage(_('To enter this section must be log in.'), 'danger');
            $this->redirect(':User:Sign:in');
        }
    }


	public function actionNew()
	{
		if ($this->user->isLoggedIn()) {
			$this->flashMessage(_('You are now logged.'), 'info');
			$this->redirect(':User:Profile:', ['id' => null]);
		}

		$token = $this->tokenRepository->getByToken($this->getParameter('hash'));

		if (!$token) {
            $this->flashMessage(_('This token does not exist.'), 'danger');
            $this->redirect(':User:Password:forgot', ['id' => null]);
        }

		if ($token->isActive() == false) {
            $this->flashMessage(_('The token has expired.'), 'danger');
            $this->redirect(':User:Password:forgot', ['id' => null]);
        }

        $email = $this->getParameter('email');

		$this->userEntity = $this->userRepository->get(['id' => $token->getUser()->getId(), 'email' => $email]);
		
		if (!$this->userEntity) {
			$this->flashMessage(_('The user of this identifier not found.'), 'danger');
			$this->redirect(':User:Sign:in', ['id' => null]);
		}
		
		if ($this->userEntity->getStatus() == UserRepository::STATUS_BLOCKED) {
			$this->flashMessage(_('This user account is blocked.'), 'danger');
			$this->redirect(':User:Sign:in', ['id' => null]);
		}

        if ($this->userEntity->getStatus() == UserRepository::STATUS_VERIFY_EMAIL) {
            $this->flashMessage(_('This user account is not activated. An activation link has been sent to your email.'), 'danger');
            $this->redirect(':User:Sign:in', ['id' => null]);
        }
	}


    /** renders ***************************************************************/

    public function renderChange()
    {
        $this->template->siteTitle = _('Change password');
    }	
    
    
    public function renderForgot()
    {
        $this->template->siteTitle = _('Reset password');
    }
	
	
	public function renderNew()
	{
		$this->template->siteTitle = _('Enter a new password');
	}


    public function renderSubmit()
    {
        $this->template->siteTitle = _('Password change link was sent to your mail');
    }


    /** components ************************************************************/

    /**
     * Forgotten password form
     *
     * @return BaseForm
     */
    protected function createComponentPasswordChangeForm()
    {
        return $this->context
                    ->getService('PasswordChangeFormBuilder')
                    ->build();
    }


    /**
     * Forgotten password form
     *
     * @return BaseForm
     */
    protected function createComponentPasswordForgotForm()
    {
        return $this->context
                    ->getService('PasswordForgotFormBuilder')
                    ->build();
    }


    /**
     * New password form
     *
     * @return \Nette\Application\UI\Form
     */
    protected function createComponentPasswordNewForm()
    {
        return $this->context
                    ->getService('PasswordNewFormBuilder')
                    ->build();
    }

}
