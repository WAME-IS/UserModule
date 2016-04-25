<?php

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;
use Wame\PermissionModule\Repositories\RoleRepository;
use Wame\UserModule\Forms\SignUpForm;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Vendor\Wame\AdminModule\Forms\CreateUserForm;

class UserPresenter extends \App\AdminModule\Presenters\BasePresenter
{	
	/** @var array */
	private $roleList;
	
	/** @var CreateUserForm @inject */
	public $createUserForm;
	
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
	
	protected function createComponentCreateUserForm() 
	{
		$form = $this->createUserForm->create();

		$form->onSuccess[] = [$this, 'signUpFormSucceeded'];
		
//		if ($this->action == 'edit' && is_numeric($this->id)) {
//			$defaults = $this->userRepository->get(['id' => $this->id]);
//
//			$form->setDefaults([
//				'title' => $defaults->title,
//				'slug' => $defaults->slug,
//				'status' => $defaults->status,
//				'description' => $defaults->description,
//				'text' => $defaults->text
//			]);
//		}
		
		return $form;
	}

	public function signUpFormSucceeded(Form $form, $values)
	{
		try {
			if ($this->action == 'edit') {
				$userEntity = $this->userRepository->set($this->id, $values);
				
				$this->userRepository->onEdit($form, $values, $userEntity);
				
				$this->flashMessage(_('The user was successfully updated'), 'success');
			} elseif ($this->action == 'create') {
				$this->userRepository->isEmailExists($values['email']);
				
				$userEntity = $this->userRepository->create($values);
				
				$this->userRepository->onCreate($form, $values, $userEntity);

				$this->flashMessage(_('The user was successfully created'), 'success');
			}
		} catch (\Exception $e) {
			$form->addError($e->getMessage());
			$this->flashMessage($e->getMessage(), 'danger');
		}
		
		$this->redirect('this');
	}
	
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Users');
		$this->template->users = $this->userRepository->getAll(['status >' => UserRepository::STATUS_BLOCKED]);
	}
	
	
	public function renderCreate()
	{
		$this->template->siteTitle = _('Create new user');
		$this->template->setFile(__DIR__ . '/templates/User/edit.latte');
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
		
		$this->flashMessage(_('User has been successfully deleted'), 'success');
		$this->redirect(':Admin:User:', ['id' => null]);
	}

}
