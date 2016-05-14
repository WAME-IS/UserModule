<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Kdyby\Doctrine\EntityManager;
use Wame\Core\Forms\FormFactory;
use Wame\UserModule\Repositories\UserRepository;

class PasswordForgotForm extends FormFactory
{	
	/** @var EntityManager */
	private $entityManager;

	/** @var UserRepository */
	private $userRepository;
	
	
	public function __construct(EntityManager $entityManager, UserRepository $userRepository) 
	{
		parent::__construct();

		$this->entityManager = $entityManager;
		$this->userRepository = $userRepository;
	}
	
	
	public function build()
	{		
		$form = $this->createForm();

		$form->addSubmit('submit', _('Send'));
		
		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		try {
			$this->userRepository->resetPassword(['email' => $values['email']]);

			$presenter->flashMessage(_('To your inbox will be sent an email with a link to create a new password.'), 'success');

			$presenter->redirect(':User:Sign:in');
		} catch (\Exception $e) {
			if ($e instanceof \Nette\Application\AbortException) {
				throw $e;
			}
			
			$form->addError($e->getMessage());
			$this->entityManager->clear();
		}
	}

}
