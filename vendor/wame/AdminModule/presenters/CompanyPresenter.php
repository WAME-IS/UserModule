<?php

namespace App\AdminModule\Presenters;

use Wame\DynamicObject\Vendor\Wame\AdminModule\Presenters\AdminFormPresenter;
use Wame\UserModule\Repositories\CompanyRepository;
use Wame\UserModule\Vendor\Wame\AdminModule\Forms\CompanyFormBuilder;
use Wame\UserModule\Vendor\Wame\AdminModule\Grids\CompanyGrid;

class CompanyPresenter extends AdminFormPresenter
{
	/** @var CompanyFormBuilder @inject */
	public $formBuilder;
	
	/** @var CompanyRepository @inject */
	public $companyRepository;
    
    /** @var CompanyGrid @inject */
	public $companyGrid;
    
    
    /** actions ***************************************************************/
	
    public function actionEdit()
    {
        $this->entity = $this->companyRepository->get(['id' => $this->id]);
    }
    
    
    /** handles ***************************************************************/
	
    
    
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
	}
	
	
	public function renderDelete()
	{
		$this->template->siteTitle = _('Deleting company');
	}
	
	
	public function handleDelete()
	{
		$this->companyRepository->delete(['id' => $this->id]);
		
		$this->flashMessage(_('Company has been successfully deleted.'), 'success');
		$this->redirect(':Admin:Company:', ['id' => null]);
	}
    
    
    /** components ****************************************************************************************************/
    
    /**
	 * Create user grid component
     * 
	 * @return UserGrid
	 */
	protected function createComponentCompanyGrid()
	{
        $qb = $this->companyRepository->createQueryBuilder('a');
		$this->companyGrid->setDataSource($qb);
		
		return $this->companyGrid;
	}


	/** abstract methods **********************************************************************************************/

	/** {@inheritdoc} */
    protected function getFormBuilderServiceAlias()
    {
        return "Admin.CompanyFormBuilder";
    }

}
