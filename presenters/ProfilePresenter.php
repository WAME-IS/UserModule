<?php

namespace App\UserModule\Presenters;

use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserEntity;

class ProfilePresenter extends \App\Core\Presenters\BasePresenter
{	
	/** @var UserRepository @inject */
	public $userRepository;
	
	/** @var UserEntity */
	private $userEntity;
	
	
	public function actionDefault()
	{
		if (!$this->user->isLoggedIn()) {
			$this->flashMessage(_('To enter this section must be log in.'), 'danger');
			$this->redirect(':User:Sign:in');
		}
		
		$this->userEntity = $this->userRepository->get(['id' => $this->user->id]);
        
        $this->getStatus()->set('user', $this->userEntity);
	}
	
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Profile');
		$this->template->userEntity = $this->userEntity;
	}

}
