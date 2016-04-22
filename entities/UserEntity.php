<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use \Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_user")
 * @ORM\Entity
 */
class UserEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;
	use Columns\Lang;
	use Columns\Status;
	use Columns\Token;

    /**
	 * @ORM\ManyToOne(targetEntity="UserEntity")
	 * @ORM\JoinColumn(name="referal_id", referencedColumnName="id", nullable=true)
     */
    protected $referal = null;

    /**
     * @ORM\Column(name="role", type="string", length=20, nullable=false)
    */
    protected $role = 'contact';

    /**
     * @ORM\Column(name="password", type="string", length=64, nullable=true)
     */
    protected $password;
 
    /**
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    protected $email;
 
    /**
     * @ORM\Column(name="nick", type="string", length=30, nullable=true)
     */
    protected $nick = null;
 
    /**
     * @ORM\Column(name="register_date", type="datetime", nullable=true)
     */
    protected $registerDate;
 
    /**
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    protected $lastLogin;

	/**
	 * @ORM\ManyToOne(targetEntity="UserInfoEntity")
	 * @ORM\JoinColumn(name="info_id", referencedColumnName="id", nullable=true)
	 */
    protected $info;
	
	/** Get ********************************************************************************/
	
	public function getName()
	{
		return $this->info->firstName . ' ' . $this->info->lastName;
	}

	public function getFullName()
	{
		$return = '';
		
		if ($this->info->degree) {
			$return .= $this->info->degree . ' ';
		}
		
		$return .= $this->getName();
		
		if ($this->info->degreeSuffix) {
			$return .= ' ' . $this->info->degreeSuffix;
		}
		
		return $return;
	}

}