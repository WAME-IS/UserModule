<?php

namespace App\AdminModule\Presenters;

use Wame\ComponentModule\Forms\ComponentForm;
use Wame\PositionModule\Repositories\PositionRepository;

class UserControlPresenter extends ComponentPresenter
{		
	/** @var ComponentForm @inject */
	public $componentForm;

	/** @var PositionRepository @inject */
	public $positionRepository;

	
	public function actionCreate()
	{
		if (!$this->user->isAllowed('userControl', 'create')) {
			$this->flashMessage(_('To enter this section you do not have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:');
		}
		
		if ($this->getParameter('p')) {
			$position = $this->positionRepository->get(['id' => $this->getParameter('p')]);
			
			if (!$position) {
				$this->flashMessage(_('This position does not exist.'), 'danger');
				$this->redirect(':Admin:Component:', ['id' => null]);
			}
			
			if ($position->status == PositionRepository::STATUS_REMOVE) {
				$this->flashMessage(_('This position is removed.'), 'danger');
				$this->redirect(':Admin:Component:', ['id' => null]);
			}
			
			if ($position->status == PositionRepository::STATUS_DISABLED) {
				$this->flashMessage(_('This position is disabled.'), 'warning');
			}
		}
	}
	
	
	public function actionEdit()
	{
		if (!$this->user->isAllowed('userControl', 'edit')) {
			$this->flashMessage(_('To enter this section you do not have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:');
		}
	}
	

	/**
	 * Menu component form
	 * 
	 * @return ComponentForm
	 */
	protected function createComponentUserControlForm()
	{
		$form = $this->componentForm
						->setType('UserComponent')
						->setId($this->id)
						->build();
		
		return $form;
	}
	
	
	public function renderCreate()
	{
		$this->template->siteTitle = _('Create user');
	}
	
	
	public function renderEdit()
	{
		$this->template->siteTitle = _('Edit user');
	}
	
}
