<?php

namespace App\AdminModule\Presenters;

use \Wame\UserModule\Entities\UserEntity;

class UserPresenter extends \App\AdminModule\Presenters\BasePresenter
{	
	/** @var \Wame\UserModule\Entities\UserEntity */
	private $userEntity;
	
	public function actionDefault()
	{
		$this->userEntity = $this->entityManager->getRepository(UserEntity::class)->findOneBy(['token' => $this->id]);
	}
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Užívatelia');
		$this->template->userEntity = $this->userEntity;
	}

}
