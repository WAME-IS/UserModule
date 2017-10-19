<?php

namespace App\AdminModule\Presenters;

use Wame\DynamicObject\Vendor\Wame\AdminModule\Presenters\AdminFormPresenter;
use Wame\UserModule\Entities\CompanyEntity;
use Wame\UserModule\Repositories\CompanyRepository;
use Wame\UserModule\Repositories\UserInCompanyRepository;


class CompanyPresenter extends AdminFormPresenter
{
	/** @var CompanyRepository @inject */
	public $repository;

	/** @var UserInCompanyRepository @inject */
	public $userInCompanyRepository;

	/** @var CompanyEntity */
	protected $entity;


    /** actions ***************************************************************/

    public function actionEdit()
    {
        parent::actionEdit();

        if (!$this->entity) {
            $this->redirect(':Admin:Company:', ['id' => null]);
        }

        $this->count = $this->userInCompanyRepository->countBy(['company' => $this->entity]);
    }


    /** handles ***************************************************************/

    public function handleDelete()
	{
		$this->repository->changeStatus(['id' => $this->id]);

		$this->flashMessage(sprintf(_('Company %s has been successfully deleted.'), $this->entity->getName()), 'success');
		$this->redirect(':Admin:Company:', ['id' => null]);
	}


    /** renders ***************************************************************/

	public function renderDefault()
	{
		$this->template->siteTitle = _('Companies');
	}


	public function renderCreate()
	{
		$this->template->siteTitle = _('Create new company');
	}


	public function renderEdit()
	{
		$this->template->siteTitle = _('Edit company');
		$this->template->subTitle = $this->entity->getName();
        $this->template->count = $this->count;
	}


	public function renderDelete()
	{
		$this->template->siteTitle = _('Deleting company');
		$this->template->subTitle = $this->entity->getName();
	}


	/** abstract methods **********************************************************************************************/

	/** {@inheritdoc} */
    protected function getFormBuilderServiceAlias()
    {
        return 'Admin.CompanyFormBuilder';
    }


    /** {@inheritdoc} */
    protected function getGridServiceAlias()
    {
        return 'Admin.CompanyGrid';
    }

}
