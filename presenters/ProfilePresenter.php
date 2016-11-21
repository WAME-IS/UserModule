<?php

namespace App\UserModule\Presenters;

use App\Core\Presenters\BasePresenter;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\UserRepository;

class ProfilePresenter extends BasePresenter
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
		
		$this->userEntity = $this->user->getEntity();
        
        $this->getStatus()->set(UserEntity::class, $this->userEntity);
	}
	
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Profile');
		$this->template->userEntity = $this->userEntity;
	}

}
