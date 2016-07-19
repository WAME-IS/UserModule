<?php

namespace App\UserModule\Presenters;

class SettingsPresenter extends \App\Core\Presenters\BasePresenter
{
	public function actionDefault()
	{
		if (!$this->user->isLoggedIn()) {
			$this->flashMessage(_('To enter this section must be log in.'), 'danger');
			$this->redirect(':User:Sign:in');
		}
	}
	
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Settings');
	}

}
