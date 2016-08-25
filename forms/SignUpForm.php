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
			$userEntity = $this->create($presenter, $values);

			$this->userRepository->onCreate($form, $values, $userEntity);

			$presenter->flashMessage(_('Registration has been successfully completed.'), 'success');

			$presenter->redirect(':User:Sign:in', ['id' => null]);
		} catch (\Exception $e) {
            \Wame\Utils\Exception::handleException($e, $form);
		}
	}
	
	
	/**
	 * Create user
	 * 
	 * @param Presenter $presenter
	 * @param array $values
	 * @return UserEntity
	 */
	private function create($presenter, $values)
	{
        //Todo: oddeliť password
		$password = $this->userRepository->getPassword($values);
		
		$userInfoEntity = $presenter->getStatus()->get('userInfoEntity');
        
        if (!$userInfoEntity) {
            $userInfoEntity = new UserInfoEntity();
            $userInfoEntity->setImportUserId(time());
        }
		
		$userEntity = $presenter->getStatus()->get('userEntity');
		$userEntity->setInfo($userInfoEntity);
		$userEntity->setLang($this->lang);
		$userEntity->setToken($this->userRepository->generateToken());
		$userEntity->setPassword($password);
		$userEntity->setRegisterDate(\Wame\Utils\Date::toDateTime('now'));
		$userEntity->setStatus(UserRepository::STATUS_ACTIVE);
		
		return $this->userRepository->create($userEntity);
	}

}
