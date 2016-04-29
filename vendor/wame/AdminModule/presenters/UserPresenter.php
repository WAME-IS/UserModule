<?php

namespace App\AdminModule\Presenters;

use Wame\PermissionModule\Repositories\RoleRepository;
use Wame\UserModule\Forms\SignUpForm;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Vendor\Wame\AdminModule\Forms\CreateUserForm;
use Wame\UserModule\Vendor\Wame\AdminModule\Forms\EditUserForm;

class UserPresenter extends \App\AdminModule\Presenters\BasePresenter
{	
	/** @var array */
	private $roleList;
	
	/** @var \Wame\UserModule\Entities\UserEntity */
	private $userEntity;
	
	/** @var CreateUserForm @inject */
	public $createUserForm;
	
	/** @var EditUserForm @inject */
	public $editUserForm;
	
	/** @var RoleRepository @inject */
	public $roleRepository;

	/** @var SignUpForm @inject */
	public $signUpForm;
	
	/** @var UserRepository @inject */
	public $userRepository;
	
	public function startup() 
	{
		parent::startup();
		
		$this->roleList = $this->roleRepository->getRoles();
	}
	
	public function actionDefault()
	{
		if (!$this->user->isAllowed('admin.user', 'view')) {
			$this->flashMessage(_('To enter this section you have not sufficient privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:');
		}
	}
	
	public function actionEdit()
	{
		if ($this->id) {
			$this->userEntity = $this->userRepository->get(['id' => $this->id]);
		}
	}
	
	/**
	 * Create user
	 * 
	 * @return CreateUserForm
	 */
	protected function createComponentCreateUserForm() 
	{
		$form = $this->createUserForm->build();

		return $form;
	}
	
	/**
	 * Edit user
	 * 
	 * @return EditUserForm
	 */
	protected function createComponentEditUserForm() 
	{
		$form = $this->editUserForm->setId($this->id)->build();

		return $form;
	}
	
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Users');
		$this->template->users = $this->userRepository->find(['status >' => UserRepository::STATUS_BLOCKED]);
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
	
	
	public function handleDelete()
	{
		$this->userRepository->delete(['id' => $this->id]);
		
		$this->flashMessage(_('User has been successfully deleted.'), 'success');
		$this->redirect(':Admin:User:', ['id' => null]);
	}

}
