<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Wame\Core\Entities\BaseEntity;
use Wame\Core\Entities\Columns;
use Wame\LocationModule\Entities\Columns\Address;
use Wame\RestApiModule\DataConverter\Annotations\noApi;

/**
 * @ORM\Table(name="wame_user")
 * @ORM\Entity
 */
class UserEntity extends BaseEntity implements IIdentity
{
	use Columns\Identifier;
	use Columns\Lang;
	use Columns\Status;
	use Columns\Description;

    use Address;


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
	 * @var \DateTime
     * @ORM\Column(name="register_date", type="datetime", nullable=true)
     */
    protected $registerDate;

    /**
	 * @var \DateTime
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * @ORM\Column(name="first_name", type="string", length=50, nullable=true)
     */
    protected $firstName = null;

    /**
     * @ORM\Column(name="last_name", type="string", length=50, nullable=true)
     */
    protected $lastName = null;

    /**
     * @ORM\Column(name="salutation", type="integer", length=1, nullable=true)
     */
    protected $salutation = null;

    /**
     * @ORM\Column(name="degree", type="string", length=30, nullable=true)
     */
    protected $degree = null;

    /**
     * @ORM\Column(name="degree_suffix", type="string", length=30, nullable=true)
     */
    protected $degreeSuffix = null;

    /**
     * @ORM\Column(name="gender", type="integer", length=1, nullable=true)
     */
    protected $gender = null;

    /**
     * @var \DateTime
     * @ORM\Column(name="birthdate", type="datetime", nullable=true)
     */
    protected $birthdate;

    /**
     * @noApi
     * @ORM\OneToOne(targetEntity="\Wame\UserModule\Entities\TokenEntity", mappedBy="user")
     */
    protected $token;


	/** get *******************************************************************/

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
		return $this->firstName . ' ' . $this->lastName;
	}

	public function getFullName()
	{
		$return = '';

		if ($this->degree) {
			$return .= $this->degree . ' ';
		}

		$return .= $this->getName();

		if ($this->degreeSuffix) {
			$return .= ' ' . $this->degreeSuffix;
		}

		return $return;
	}

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getSalutation()
    {
        return $this->salutation;
    }

    public function getDegree()
    {
        return $this->degree;
    }

    public function getDegreeSuffix()
    {
        return $this->degreeSuffix;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getToken()
    {
        return $this->token;
    }


	/** set *******************************************************************/

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

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;

        return $this;
    }

    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    public function setDegreeSuffix($degreeSuffix)
    {
        $this->degreeSuffix = $degreeSuffix;

        return $this;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    public function setBirthdate($birthdate)
    {
        if($birthdate) {
            $this->birthdate = new \DateTime(date('Y-m-d', strtotime($birthdate)));
        }

        return $this;
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }


    /** remove ****************************************************************/

    public function removeToken()
    {
        $this->token->clear();
    }

}