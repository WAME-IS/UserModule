<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\LocationModule\Entities\Columns\Address;

/**
 * @ORM\Table(name="wame_company")
 * @ORM\Entity
 */
class CompanyEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;
	use Columns\CreateDate;
	use Columns\CreateUser;
	use Columns\Description;
	use Columns\EditDate;
	use Columns\EditUser;
	use Columns\Name;
	use Columns\Parameters;
	use Columns\Slug;
	use Columns\Status;
	use Columns\Token;
	use Address;


    /**
     * @ORM\Column(name="ico", type="string", length=20, nullable=true)
     */
    protected $ico;

    /**
     * @ORM\Column(name="dic", type="string", length=30, nullable=true)
     */
    protected $dic;

    /**
     * @ORM\Column(name="ic_dph", type="string", length=40, nullable=true)
     */
    protected $icDph;

	
	/** get ************************************************************/

	public function getIco()
	{
		return $this->ico;
	}

	public function getDic()
	{
		return $this->dic;
	}

	public function getIcDph()
	{
		return $this->icDph;
	}


	/** set ************************************************************/

	public function setIco($ico)
	{
		$this->ico = str_replace(' ', '', $ico);
		
		return $this;
	}

	public function setDic($dic)
	{
		$this->dic = str_replace(' ', '', $dic);
		
		return $this;
	}

	public function setIcDph($icDph)
	{
		$this->icDph = str_replace(' ', '', $icDph);
		
		return $this;
	}

}