<?php

namespace App\UserModule\Presenters;


use Wame\UserModule\Entities\UserEntity;


class SettingsPresenter extends \App\Core\Presenters\BasePresenter
{
    /** @var UserEntity */
    protected $entity;


    /** actions ***************************************************************/

    public function actionDefault()
    {
        if (!$this->user->isLoggedIn()) {
            $this->flashMessage(_('To enter this section must be log in.'), 'danger');
            $this->redirect(':User:Sign:in');
        }

        $this->entity = $this->user->getEntity();
    }


    public function actionAccount()
    {
        if (!$this->user->isLoggedIn()) {
            $this->flashMessage(_('To enter this section must be log in.'), 'danger');
            $this->redirect(':User:Sign:in');
        }

        $this->entity = $this->user->getEntity();
    }


    /** renders ***************************************************************/

    public function renderDefault()
    {
        $this->template->siteTitle = _('Settings');
    }


    public function renderAccount()
    {
        $this->template->siteTitle = _('Account');
    }


    /** components ************************************************************/

    /**
	 * User settings form
	 * 
	 * @return UserSettingsForm
	 */
	protected function createComponentUserSettingsAccountForm()
	{
        return $this->context
                    ->getService('UserSettingsAccountFormBuilder')
                    ->setEntity($this->entity)
                    ->build();
	}

}
