<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use \Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_company")
 * @ORM\Entity
 */
class CompanyEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;
	use Columns\Status;
	use Columns\Token;

    /**
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(name="ico", type="string", length=20, nullable=false)
     */
    protected $ico;

    /**
     * @ORM\Column(name="dic", type="string", length=30, nullable=false)
     */
    protected $dic;

    /**
     * @ORM\Column(name="ic_dph", type="string", length=40, nullable=false)
     */
    protected $icDph;


    /**
     * @ORM\Column(name="company_image", type="string", length=255, nullable=true)
     */
    protected $companyImage = null;
	
    /**
 	 * @ORM\ManyToOne(targetEntity="\Wame\PlaceModule\Entities\AddressEntity")
	 * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=false)
     */
    protected $address;

}