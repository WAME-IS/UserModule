<?php

namespace App\AdminModule\Presenters;

use Wame\PermissionModule\Repositories\RoleRepository;
use Wame\UserModule\Forms\SignUpForm;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserEntity;
use Wame\DynamicObject\Vendor\Wame\AdminModule\Presenters\AdminFormPresenter;


class UserPresenter extends AdminFormPresenter
{
	/** @var SignUpForm @inject */
	public $signUpForm;
	
	/** @var UserRepository @inject */
	public $repository;
    
    
    /** actions ***************************************************************/
	
	public function actionEdit()
	{
		if ($this->id) {
			$this->entity = $this->repository->get(['id' => $this->id]);
		}
	}
	
	public function actionShow()
	{
		if ($this->id) {
			$this->entity = $this->repository->get(['id' => $this->id]);
            $this->getStatus()->set(UserEntity::class, $this->entity);
		}
	}
    
    
    /** handles ***************************************************************/
	
	public function handleDelete()
	{
		$this->repository->delete(['id' => $this->id]);
		
		$this->flashMessage(_('User has been successfully deleted.'), 'success');
		$this->redirect(':Admin:User:', ['id' => null]);
	}

    
    /** renders ***************************************************************/
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Users');
		$this->template->users = $this->repository->find(['status >' => UserRepository::STATUS_BLOCKED]);
	}
	
	
	public function renderShow()
	{
		$this->template->siteTitle = _('Show user');
	}
	
	
	public function renderCreate()
	{
		$this->template->siteTitle = _('Create new user');
	}
	
	
	public function renderEdit()
	{
		$this->template->siteTitle = _('Edit user');
	}
	
	
	public function renderDelete()
	{
		$this->template->siteTitle = _('Deleting user');
	}
    

    /** implements ************************************************************/
    
    /** {@inheritDoc} */
    protected function getFormBuilderServiceAlias()
    {
        return "Admin.UserFormBuilder";
    }
    
    
    /** {@inheritDoc} */
    protected function getGridServiceAlias()
    {
        return "Admin.UserGrid";
    }

}
