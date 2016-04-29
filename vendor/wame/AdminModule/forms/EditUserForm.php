<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Forms;

use Nette\Application\UI\Form;
use Kdyby\Doctrine\EntityManager;
use Wame\Core\Forms\FormFactory;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserEntity;

class EditUserForm extends FormFactory
{	
	/** @var EntityManager */
	private $entityManager;
	
	/** @var UserRepository */
	private $userRepository;
	
	/** @var UserEntity */
	public $userEntity;
	
	
	public function __construct(EntityManager $entityManager, UserRepository $userRepository) 
	{
		parent::__construct();

		$this->entityManager = $entityManager;
		$this->userRepository = $userRepository;
	}
	
	
	public function build()
	{
		$form = $this->createForm();

		$form->addSubmit('submit', _('Edit user'));
		
		if ($this->id) {
			$this->userEntity = $this->userRepository->get(['id' => $this->id]);
			$this->setDefaultValues();
		}
		
		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();
		
		$this->entityManager->getConnection()->beginTransaction();

		try {
			$userEntity = $this->update($presenter->id, $values);

			$this->userRepository->onUpdate($form, $values, $userEntity);

			$presenter->flashMessage(_('The user was successfully updated.'), 'success');
			
			$this->entityManager->getConnection()->commit();
			
			$presenter->redirect('this');
		} catch (\Exception $e) {
			if ($e instanceof \Nette\Application\AbortException) {
				throw $e;
			}
			
			$form->addError($e->getMessage());
			$this->entityManager->getConnection()->rollback();
		}
	}

	
	/**
	 * Update user
	 * 
	 * @param int $userId
	 * @param array $values
	 * @return UserEntity
	 */
	private function update($userId, $values)
	{
		$userEntity = $this->userRepository->get(['id' => $userId]);
		
		$userEntity->email = $values['email'];
		$userEntity->role = $values['role'];
		$userEntity->info->degree = $values['degree'];
		$userEntity->info->firstName = $values['first_name'];
		$userEntity->info->lastName = $values['last_name'];
		$userEntity->info->text = $values['text'];
		
		if ($values['birthdate']) {
			$userEntity->info->birthdate = $this->formatDate($values['birthdate'], 'Y-m-d');
		} else {
			$userEntity->info->birthdate = null;
		}
		
		return $this->userRepository->update($userEntity);
	}

}