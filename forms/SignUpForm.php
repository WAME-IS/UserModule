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
	
	/** @var string */
	private $lang;
	
	
	public function __construct(UserRepository $userRepository) 
	{
		parent::__construct();

		$this->userRepository = $userRepository;
		$this->lang = $userRepository->lang;
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

			$presenter->redirect(':User:Sign:in', ['id' => null]);
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
		$userInfoEntity->setFirstName($values['first_name']);
		$userInfoEntity->setLastName($values['last_name']);
		$userInfoEntity->setDegree($values['degree']);
		$userInfoEntity->setText($values['text']);
		
		if ($values['birthdate']) {
			$userInfoEntity->setBirthdate(\Wame\Utils\Date::toDateTime($values['birthdate'], 'Y-m-d'));
		} else {
			$userInfoEntity->setBirthdate(null);
		}
		
		$userEntity = new UserEntity();
		$userEntity->setInfo($userInfoEntity);
		$userEntity->setLang($this->lang);
		$userEntity->setToken($this->userRepository->generateToken());
		$userEntity->setEmail($values['email']);
		$userEntity->setNick($values['nick']);
		$userEntity->setPassword(Passwords::hash($password));
		$userEntity->setRegisterDate(\Wame\Utils\Date::toDateTime('now'));
		$userEntity->setStatus(UserRepository::STATUS_ACTIVE);
		
		return $this->userRepository->create($userEntity);
	}

}
