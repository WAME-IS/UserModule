<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Wame\Core\Forms\FormFactory;
use Wame\UserModule\Repositories\UserRepository;

class UserSettingsForm extends FormFactory
{	
	/** @var UserRepository */
	private $userRepository;
	
	/** @var string */
	public $lang;
	
	
	public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        
		$this->userRepository = $userRepository;
		$this->lang = $userRepository->lang;
	}
	
	
	public function build()
	{
		$form = $this->createForm();

		if (count($this->getFormContainers()) > 0) {
			$form->addSubmit('submit', _('Save'));

//			$this->userEntity = $this->userRepository->findPairs(['type' => $this->id], 'value', [], 'name');
			
			$this->setDefaultValues();
		}

		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	
	/**
	 * Form succeeded
	 * 
	 * @param Form $form	form
	 * @param type $values	values
	 * @throws \Exception	exception
	 */
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		try {
            // TODO: odkomentovat az bude doriesene ci settings budu cez parametre alebo samostatnu tabulku
//			$this->userRepository->onUpdate($form, $values);

			$presenter->flashMessage(_('Settings has been successfully updated.'), 'success');
			$presenter->redirect('this');
		} catch (Exception $e) {
			if ($e instanceof AbortException) {
				throw $e;
			}
			
			$form->addError($e->getMessage());
			$this->entityManager->clear();
		}
	}
	
}
