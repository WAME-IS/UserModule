<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Nette\Security\Passwords;
use Wame\Core\Forms\FormFactory;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Entities\UserInfoEntity;

class SignUpForm extends FormFactory
{	
	/** @var UserRepository */
	private $userRepository;
	
	/** @var UserEntity */
	public $userEntity;
	
	
	public function __construct(UserRepository $userRepository) 
	{
		parent::__construct();

		$this->userRepository = $userRepository;
	}
	
	
	public function build()
	{		
		$form = $this->createForm();

		$form->addSubmit('submit', _('Sign up'));
		
		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		try {
			$userEntity = $this->create($values);

			$this->userRepository->onCreate($form, $values, $userEntity);

			$presenter->flashMessage(_('Registration has been successfully completed.'), 'success');

			$presenter->redirect(':User:Sign:in');
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
	private function create($values)
	{
		$password = $this->userRepository->getPassword($values);
		
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
		$userEntity->nick = $values['nick'];
		$userEntity->password = Passwords::hash($password);
		$userEntity->registerDate = $this->formatDate('now');
		$userEntity->status = UserRepository::STATUS_ACTIVE;
		
		return $this->userRepository->create($userEntity);
	}

}
