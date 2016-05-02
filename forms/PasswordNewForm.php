<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Kdyby\Doctrine\EntityManager;
use Wame\Core\Forms\FormFactory;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserEntity;

class PasswordNewForm extends FormFactory
{	
	/** @var EntityManager */
	private $entityManager;

	/** @var UserRepository */
	private $userRepository;
	
	/** @var UserEntity */
	private $userEntity;
	
	
	public function __construct(EntityManager $entityManager, UserRepository $userRepository) 
	{
		parent::__construct();

		$this->entityManager = $entityManager;
		$this->userRepository = $userRepository;
	}
	
	
	public function setUserEntity($userEntity)
	{
		$this->userEntity = $userEntity;
		
		return $this;
	}
	
	
	public function build()
	{		
		$form = $this->createForm();

		$form->addSubmit('submit', _('Save'));
		
		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		try {
			$password = $this->userRepository->getPassword($values);
			
			$this->userRepository->changePassword($this->userEntity, $password);

			$presenter->flashMessage(_('Password successfully changed, you can log in now.'), 'success');

			$presenter->redirect(':User:Sign:in', ['id' => null]);
		} catch (\Exception $e) {
			if ($e instanceof \Nette\Application\AbortException) {
				throw $e;
			}
			
			$form->addError($e->getMessage());
			$this->entityManager->clear();
		}
	}

}
