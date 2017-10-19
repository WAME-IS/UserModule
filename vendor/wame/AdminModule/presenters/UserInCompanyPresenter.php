<?php

namespace App\AdminModule\Presenters;

use Wame\DynamicObject\Vendor\Wame\AdminModule\Presenters\AdminFormPresenter;
use Wame\UserModule\Entities\CompanyEntity;
use Wame\UserModule\Entities\UserInCompanyEntity;
use Wame\UserModule\Repositories\UserInCompanyRepository;
use Wame\UserModule\Repositories\CompanyRepository;


class UserInCompanyPresenter extends AdminFormPresenter
{
	/** @var UserInCompanyRepository @inject */
	public $repository;

	/** @var CompanyRepository @inject */
	public $companyRepository;

	/** @var UserInCompanyEntity|CompanyEntity */
	protected $entity;


    /** actions ***************************************************************/

    public function actionCreate()
    {
        $this->entity = $this->companyRepository->get(['id' => $this->id]);
    }


    /** handles ***************************************************************/

	public function handleDelete()
	{
        if ($this->getParameter('c')) {
            $company = $this->companyRepository->get(['id' => $this->getParameter('c')]);
            $this->companyRepository->delete(['id' => $company->getId()]);
            $this->flashMessage(sprintf(_('Company %s has been successfully deleted.'), $company->getName()), 'success');
        } else {
            $this->repository->delete(['id' => $this->id]);
            $this->flashMessage(sprintf(_('Company %s has been successfully removed from %s user.'), $this->entity->getCompany()->getTitle(), $this->entity->getUser()->getFullName()), 'success');
        }

		$this->redirect(':Admin:User:show', ['id' => $this->entity->getUser()->getId()]);
	}


    /** renders ***************************************************************/

	public function renderCreate()
	{
		$this->template->siteTitle = _('Add user to company');
        $this->template->subTitle = $this->entity->getName();
	}


	public function renderDelete()
	{
		$this->template->siteTitle = _('Delete company');
        $this->template->subTitle = $this->entity->getName();
	}


    /** implements ************************************************************/

    /** {@inheritDoc} */
    protected function getFormBuilderServiceAlias()
    {
        return "Admin.UserInCompanyFormBuilder";
    }

}
