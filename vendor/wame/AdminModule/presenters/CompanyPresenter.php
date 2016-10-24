<?php

namespace App\AdminModule\Presenters;

use Wame\DynamicObject\Vendor\Wame\AdminModule\Presenters\AdminFormPresenter;
use Wame\UserModule\Entities\CompanyEntity;
use Wame\UserModule\Repositories\CompanyRepository;


class CompanyPresenter extends AdminFormPresenter
{
	/** @var CompanyRepository @inject */
	public $repository;

	/** @var CompanyEntity @inject */
	protected $entity;


    /** actions ***************************************************************/

    public function actionEdit()
    {
        $this->entity = $this->repository->get(['id' => $this->id]);
    }


    public function actionDelete()
    {
        $this->entity = $this->repository->get(['id' => $this->id]);
    }


    /** handles ***************************************************************/

    public function handleDelete()
	{
		$this->repository->changeStatus(['id' => $this->id]);

		$this->flashMessage(sprintf(_('Company has been successfully deleted.'), $this->entity->getName()), 'success');
		$this->redirect(':Admin:Company:', ['id' => null]);
	}


    /** renders ***************************************************************/

	public function renderDefault()
	{
		$this->template->siteTitle = _('Companies');
	}


	public function renderCreate()
	{
		$this->template->siteTitle = _('Create company');
	}


	public function renderEdit()
	{
		$this->template->siteTitle = _('Edit company');
		$this->template->subTitle = $this->entity->getName();
	}


	public function renderDelete()
	{
		$this->template->siteTitle = _('Delete company');
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
