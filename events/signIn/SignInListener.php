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
		
		if ($user->getEntity()->getStatus() == UserRepository::STATUS_BLOCKED) {
			$presenter->redirect(':User:Sign:in');
		}
		if ($user->getEntity()->getStatus() == UserRepository::STATUS_VERIFY_EMAIL) {
			$presenter->redirect(':User:Verify:email');
		}
		
// Todo: Presmerovanie na adresu odkiaľ prišiel
//		if ($this->httpRequest->getReferer()) {
//			$referer = $this->httpRequest->getReferer();
//			
//			if ($this->httpRequest->url->host == $referer->host) {
//				$presenter->redirectUrl($referer->path);
//			}
//		}

		$presenter->redirect(':User:Profile:', ['id' => null, 'lang' => $user->getEntity()->getLang()]);
	}

}
