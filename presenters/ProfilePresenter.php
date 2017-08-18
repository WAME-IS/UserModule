<?php

namespace App\UserModule\Presenters;

use App\Core\Presenters\BasePresenter;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\UserRepository;


class ProfilePresenter extends BasePresenter
{	
	/** @var UserRepository @inject */
	public $repository;
	
	/** @var UserEntity */
	private $entity;
	
	
	public function actionDefault()
	{
		if (!$this->user->isLoggedIn()) {
			$this->flashMessage(_('To enter this section must be log in.'), 'danger');
			$this->redirect(':User:Sign:in');
		}
		
		$this->entity = $this->user->getEntity();

        $this->getStatus()->set('item', $this->entity);
        $this->getStatus()->set(UserEntity::class, $this->entity);
	}
	
	
	public function renderDefault()
	{
        $this->template->siteTitle = _('Profile');
        $this->template->subTitle = $this->entity->getFullName();
		$this->template->userEntity = $this->entity;
	}

}
