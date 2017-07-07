<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_user_info")
 * @ORM\Entity
 */
class UserInfoEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;

    /**
     * @ORM\ManyToOne(targetEntity="UserEntity", inversedBy="info")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=true)
     */
	protected $user;

    /**
     * @ORM\Column(name="import_user_id", type="integer", nullable=true)
     */
    protected $importUserId = null;



    /**
	 * @var Date
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    protected $birthdate = null;

    /**
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    protected $text = null;


	/** get ********************************************************************************/

	public function getImportUserId()
	{
		return $this->importUserId;
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

	public function getText()
	{
		return $this->text;
	}


	/** set ********************************************************************************/

	public function setImportUserId($importUserId)
	{
		$this->importUserId = $importUserId;

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
		$this->birthdate = new \DateTime(date('Y-m-d', strtotime($birthdate)));

		return $this;
	}

	public function setText($text)
	{
		$this->text = $text;

		return $this;
	}

}