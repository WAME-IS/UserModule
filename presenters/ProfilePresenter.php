<?php

namespace App\UserModule\Presenters;

use \Wame\UserModule\Entities\UserEntity;

class ProfilePresenter extends \App\Core\Presenters\BasePresenter
{	
	/** @var \Wame\UserModule\Entities\UserEntity */
	private $userEntity;
	
	public function actionDefault()
	{
		if (!$this->user->isLoggedIn()) {
			$this->flashMessage('Pre vstup do tejto sekcie sa musíte prihlásiť.', 'danger');
			$this->redirect(':User:Sign:in');
		}
		
		$this->userEntity = $this->entityManager->getRepository(UserEntity::class)->findOneBy(['id' => $this->user->id]);
	}
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Užívateľ');
		$this->template->userEntity = $this->userEntity;
	}

}
