<?php

namespace Wame\UserModule\Entities;

use Wame\RestApiModule\DataConverter\Annotations\noApi;
use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Nette\Security\Passwords;

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
    protected $role = 'client';

    /**
	 * @noApi
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
	 * @var DateTime
     * @ORM\Column(name="register_date", type="datetime", nullable=true)
     */
    protected $registerDate;
 
    /**
	 * @var DateTime
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    protected $lastLogin;

	/**
	 * @ORM\ManyToOne(targetEntity="UserInfoEntity")
	 * @ORM\JoinColumn(name="info_id", referencedColumnName="id", nullable=true)
	 */
    protected $info;
	
	
	/** get ********************************************************************************/
	
	public function getInfo()
	{
		return $this->info;
	}
	
	public function getReferal()
	{
		return $this->referal;
	}
	
	public function getRole()
	{
		return $this->role;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getNick()
	{
		return $this->nick;
	}
	
	public function getRegisterDate()
	{
		return $this->registerDate;
	}
	
	public function getLastLogin()
	{
		return $this->lastLogin;
	}

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
	
	
	/** set ********************************************************************************/
	
	public function setInfo($info)
	{
		$this->info = $info;
		
		return $this;
	}
	
	public function setPassword($password)
	{
		$this->password = Passwords::hash($password);
		
		return $this;
	}
	
	public function setReferal($referal)
	{
		$this->referal = $referal;
		
		return $this;
	}
	
	public function setRole($role)
	{
		$this->role = $role;
		
		return $this;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}
	
	public function setNick($nick)
	{
		$this->nick = $nick;
		
		return $this;
	}
	
	public function setRegisterDate($registerDate)
	{
		$this->registerDate = $registerDate;
		
		return $this;
	}
	
	public function setLastLogin($lastLogin)
	{
		$this->lastLogin = $lastLogin;
		
		return $this;
	}

}