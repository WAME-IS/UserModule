<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Forms;

use Nette\Application\UI\Form;
use Wame\Core\Forms\FormFactory;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Entities\UserInfoEntity;

class CreateUserForm extends FormFactory
{	
	/** @var UserRepository */
	private $userRepository;
	
	public function __construct(UserRepository $userRepository) 
	{
		parent::__construct();

		$this->userRepository = $userRepository;
	}
	
	public function create()
	{
		$form = $this->createForm();

		$form->addSubmit('submit', _('Create user'));
		
		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		try {
			if ($presenter->action == 'edit') {
				$userEntity = $this->updateUser($presenter->id, $values);
				
				$this->userRepository->onUpdate($form, $values, $userEntity);
				
				$presenter->flashMessage(_('The user was successfully updated.'), 'success');
			} elseif ($presenter->action == 'create') {
				$userEntity = $this->createUser($values);
				
				$this->userRepository->onCreate($form, $values, $userEntity);

				$presenter->flashMessage(_('The user was successfully created.'), 'success');
			}
			
			$presenter->redirect('this');
		} catch (\Exception $e) {
			if ($e instanceof \Nette\Application\AbortException) {
				throw $e;
			}
			
			$form->addError($e->getMessage());
		}
	}
	
	
	/**
	 * Create user
	 * 
	 * @param array $values
	 * @return UserEntity
	 */
	private function createUser($values)
	{
		$userInfoEntity = new UserInfoEntity();
		$userInfoEntity->firstName = $values['first_name'];
		$userInfoEntity->lastName = $values['last_name'];
		$userInfoEntity->degree = $values['degree'];
		$userInfoEntity->text = $values['text'];
		
		if ($values['birthdate']) {
			$userInfoEntity->birthdate = $this->formatDate($values['birthdate'], 'Y-m-d');
		} else {
			$userInfoEntity->birthdate = null;
		}
		
		$userEntity = new UserEntity();
		$userEntity->info = $userInfoEntity;
		$userEntity->token = $this->userRepository->generateToken();
		$userEntity->email = $values['email'];
		$userEntity->password = null;
		$userEntity->registerDate = $this->formatDate('now');
		$userEntity->status = UserRepository::STATUS_VERIFY_EMAIL;
		
		return $this->userRepository->create($userEntity);
	}
	
	
	/**
	 * Update user
	 * 
	 * @param int $userId
	 * @param array $values
	 * @return UserEntity
	 */
	private function updateUser($userId, $values)
	{
		$userEntity = $this->userRepository->get(['id' => $userId]);
		
		// TODO: update user
		
		return $this->userRepository->update($userEntity);
	}

}