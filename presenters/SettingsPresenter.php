<?php

namespace App\UserModule\Presenters;

use Wame\UserModule\Forms\UserSettingsForm;


class SettingsPresenter extends \App\Core\Presenters\BasePresenter
{
    /** @var UserSettingsForm @inject */
	public $userSettingsForm;
    
    
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
    
    
    /**
	 * User settings form
	 * 
	 * @return UserSettingsForm
	 */
	protected function createComponentUserSettingsForm()
	{
		$form = $this->userSettingsForm
						->setId($this->id)
						->build();
		
		return $form;
	}

}
