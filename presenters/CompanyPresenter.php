<?php

namespace App\UserModule\Presenters;

use App\Core\Presenters\BasePresenter;
use Wame\UserModule\Forms\CompanyForm;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserEntity;

class CompanyPresenter extends BasePresenter
{	
	/** @var CompanyForm @inject */
	public $companyForm;
	
	/** @var UserRepository @inject */
	public $userRepository;
	
	/** @var UserEntity */
	private $userEntity;
	
	
	public function actionDefault()
	{
		if (!$this->user->isLoggedIn()) {
			$this->flashMessage(_('To enter this section must be log in.'), 'danger');
			$this->redirect(':User:Sign:in');
		}
		
		$this->userEntity = $this->userRepository->get(['id' => $this->user->id]);
	}
	
	
	public function actionCreate()
	{
		if (!$this->user->isLoggedIn()) {
			$this->flashMessage(_('To enter this section must be signed.'), 'danger');
			$this->redirect(':User:Sign:in');
		}
		
		if (!$this->user->isAllowed('company', 'create')) {
			$this->flashMessage(_('To enter this section you do not have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:', ['id' => null]);
		}
	}
	
	
	/**
	 * Company form
	 * 
	 * @return CompanyForm
	 */
	protected function createComponentCompanyForm()
	{
		$form = $this->companyForm
						->setId($this->id)
						->build();
		
		return $form;
	}
	
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Company');
	}
	
	
	public function renderCreate()
	{
		$this->template->siteTitle = _('Create company');
	}

}
