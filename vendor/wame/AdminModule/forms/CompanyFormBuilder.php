<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Forms;

use Wame\DynamicObject\Forms\EntityFormBuilder;
use Wame\UserModule\Repositories\CompanyRepository;

class CompanyFormBuilder extends EntityFormBuilder
{
	/** @var CompanyRepository */
	private $companyRepository;
	
	
	public function __construct(CompanyRepository $companyRepository)
    {
        parent::__construct();
        
		$this->companyRepository = $companyRepository;
	}
    
    
    /** {@inheritDoc} */
    public function getRepository()
    {
        return $this->companyRepository;
    }
	
}
