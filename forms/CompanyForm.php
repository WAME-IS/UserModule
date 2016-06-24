<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Nette\Utils\Strings;
use Nette\Security\User;
use Kdyby\Doctrine\EntityManager;
use Wame\Core\Forms\FormFactory;
use Wame\UserModule\Entities\CompanyEntity;
use Wame\UserModule\Repositories\CompanyRepository;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserInCompanyEntity;
use Wame\UserModule\Repositories\UserInCompanyRepository;

class CompanyForm extends FormFactory
{	
	/** @var EntityManager */
	private $entityManager;
	
	/** @var User */
	private $user;
	
	/** @var CompanyEntity */
	private $companyEntity;
	
	/** @var CompanyRepository */
	private $companyRepository;
	
	/** @var UserEntity */
	private $userEntity;
	
	/** @var UserRepository */
	private $userRepository;
	
	/** @var UserInCompanyRepository */
	private $userInCompanyRepository;
		
	
	public function __construct(
		User $user,
		EntityManager $entityManager, 
		CompanyRepository $companyRepository,
		UserRepository $userRepository,
		UserInCompanyRepository $userInCompanyRepository
	) {
		parent::__construct();

		$this->user = $user;
		$this->entityManager = $entityManager;
		$this->companyRepository = $companyRepository;
		$this->userRepository = $userRepository;
		$this->userInCompanyRepository = $userInCompanyRepository;
	}

	
	protected function attached($object) {
		parent::attached($object);
	}
	
	
	public function build()
	{
		$form = $this->createForm();

		if ($this->id) {
			$form->addSubmit('submit', _('Save'));
			
			$this->companyEntity = $this->companyRepository->get(['id' => $this->id]);
			$this->setDefaultValues();
		} else {
			$form->addSubmit('submit', _('Create'));
		}

		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		$this->userEntity = $this->userRepository->get(['id' => $this->user->id]);

		try {
			if ($this->id) {
				$companyEntity = $this->update($values);

				$this->companyRepository->onUpdate($form, $values, $companyEntity);

				$presenter->flashMessage(_('The company has been successfully updated.'), 'success');
			} else {
				$companyEntity = $this->create($values);

				$this->companyRepository->onCreate($form, $values, $companyEntity);
				
				$presenter->flashMessage(_('The company has been successfully created.'), 'success');
			}
			
			$presenter->redirect('Company:', ['id' => $companyEntity->id]);
			
		} catch (\Exception $e) {
			if ($e instanceof \Nette\Application\AbortException) {
				throw $e;
			}
			
			$form->addError($e->getMessage());
			$this->entityManager->clear();
		}
	}
	
	
	/**
	 * Create company
	 * 
	 * @param array $values
	 * @return CompanyEntity
	 */
	private function create($values)
	{
		$companyEntity = new CompanyEntity();
		$companyEntity->setCreateDate($this->formatDate('now'));
		$companyEntity->setCreateUser($this->userEntity);
		$companyEntity->setDescription($values['description']);
		$companyEntity->setName($values['name']);
		$companyEntity->setSlug(Strings::webalize($values['name']));
		$companyEntity->setIco($values['ico']);
		$companyEntity->setDic($values['dic']);
		$companyEntity->setIcDph($values['icDph']);
		$companyEntity->setToken(time());
		$companyEntity->setStatus(CompanyRepository::STATUS_ACTIVE);
		
		$this->companyRepository->create($companyEntity);
		
		$userInCompanyEntity = new UserInCompanyEntity();
		$userInCompanyEntity->setCompany($companyEntity);
		$userInCompanyEntity->setUser($this->userEntity);
		$userInCompanyEntity->setCreateDate($this->formatDate('now'));
		
		$this->userInCompanyRepository->create($userInCompanyEntity);
		
		return $companyEntity;
	}
	
	
	/**
	 * Update company
	 * 
	 * @return CompanyEntity
	 */
	private function update()
	{
		$this->companyEntity->setEditDate($this->formatDate('now'));
		$this->companyEntity->setEditUser($this->userEntity);
		
		return $this->companyRepository->update($this->companyEntity);
	}

}
