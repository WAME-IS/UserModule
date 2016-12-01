<?php

namespace App\AdminModule\Presenters;

use Wame\DynamicObject\Vendor\Wame\AdminModule\Presenters\AdminFormPresenter;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\UserRepository;


class UserPresenter extends AdminFormPresenter
{
	/** @var UserRepository @inject */
	public $repository;

	/** @var UserEntity */
	protected $entity;


    /** actions ***************************************************************/

	public function actionShow()
	{
        parent::actionShow();

        $this->getStatus()->set(UserEntity::class, $this->entity);
	}


    /** handles ***************************************************************/

	public function handleDelete()
	{
		$this->repository->delete(['id' => $this->id]);

		$this->flashMessage(sprintf(_('User #%s has been successfully deleted.'), $this->id), 'success');
		$this->redirect(':Admin:User:', ['id' => null]);
	}


    /** renders ***************************************************************/

	public function renderDefault()
	{
		$this->template->siteTitle = _('Users');
		$this->template->users = $this->repository->find(['status >' => UserRepository::STATUS_BLOCKED]);
	}


	public function renderShow()
	{
		$this->template->siteTitle = _('User');
        $this->template->subTitle = $this->entity->getFullName();
	}


	public function renderCreate()
	{
		$this->template->siteTitle = _('Create user');
	}


	public function renderEdit()
	{
		$this->template->siteTitle = _('Edit user');
        $this->template->subTitle = $this->entity->getFullName();
	}


	public function renderDelete()
	{
		$this->template->siteTitle = _('Delete user');
        $this->template->subTitle = $this->entity->getFullName();
	}


    /** implements ************************************************************/

    /** {@inheritDoc} */
    protected function getFormBuilderServiceAlias()
    {
        return "Admin.UserFormBuilder";
    }


    /** {@inheritDoc} */
    protected function getGridServiceAlias()
    {
        return "Admin.UserGrid";
    }

}
