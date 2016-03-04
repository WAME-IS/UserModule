<?php

namespace Wame\UserModule\Events;

use Nette\Object;
use Nette\Application\Application;
use Nette\Http\Request;
use Nette\Security\User;
use Wame\UserModule\Repositories\UserRepository;

class SignInListener extends Object 
{
	/** @var \Nette\Application\Application */
	public $application;
	
	/** @var \Nette\Http\Request */
	private $httpRequest;

	public function __construct(Application $application, Request $httpRequest, User $user)
	{
		$this->application = $application;
		$this->httpRequest = $httpRequest;
		
		$user->onLoggedIn[] = [$this, 'redirectAfterLogin'];
	}

	public function redirectAfterLogin(User $user) 
	{
		$presenter = $this->application->getPresenter();
		
		if ($user->identity->status == UserRepository::STATUS_BLOCKED) {
			$presenter->redirect(':Homepage:Homepage:');
		}
		if ($user->identity->status == UserRepository::STATUS_VERIFY_PHONE) {
			$presenter->redirect(':User:Verify:phone');
		}
		if ($user->identity->status == UserRepository::STATUS_VERIFY_EMAIL) {
			$presenter->redirect(':User:Verify:email');
		}

//		if ($user->isInRole('administrator')) {
//			$presenter->redirect(':Admin:Dashboard:');
//		}
		
//		if ($this->httpRequest->getReferer()) {
//			$referer = $this->httpRequest->getReferer();
//			
//			if ($this->httpRequest->url->host == $referer->host) {
//				$presenter->redirectUrl($referer->path);
//			}
//		}
		
		$presenter->flashMessage(_('Boli ste úspešne prihlásený.'), 'success');
		$presenter->redirect(':User:Profile:');
	}

}
