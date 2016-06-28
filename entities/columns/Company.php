<?php

namespace Wame\UserModule\Entities\Columns;

trait Company
{
    /**
	 * @ORM\ManyToOne(targetEntity="\Wame\UserModule\Entities\CompanyEntity")
	 * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=true)
	 */
	protected $company;

	
	/** get ************************************************************/

	public function getCompany()
	{
		return $this->company;
	}


	/** set ************************************************************/

	public function setCompany($company)
	{
		$this->company = $company;
		
		return $this;
	}
	
}