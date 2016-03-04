<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="wame_user_info")
 * @ORM\Entity
 */
class UserInfoEntity extends \Wame\Core\Entities\BaseEntity
{	
	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="import_user_id", type="integer", nullable=true)
     */
    protected $importUserId = null;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=true)
     */
    protected $firstName = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=true)
     */
    protected $lastName = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="salutation", type="integer", length=1, nullable=false)
     */
    protected $salutation = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="degree", type="string", length=30, nullable=true)
     */
    protected $degree = null;

    /**
     * @var string
     *
     * @ORM\Column(name="degree_suffix", type="string", length=30, nullable=true)
     */
    protected $degreeSuffix = null;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date", nullable=false)
     */
    protected $birthdate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50, nullable=true)
     */
    protected $phone = null;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    protected $website = null;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=false)
     */
    protected $text = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=150, nullable=true)
     */
    protected $street = null;

    /**
     * @var string
     *
     * @ORM\Column(name="house_number", type="string", length=30, nullable=true)
     */
    protected $houseNumber = null;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=20, nullable=true)
     */
    protected $zipCode = null;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=250, nullable=true)
     */
    protected $city = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="country_id", type="integer", length=3, nullable=true)
     */
    protected $countryId = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="bank_id", type="integer", length=5, nullable=true)
     */
    protected $bankId = null;

    /**
     * @var string
     *
     * @ORM\Column(name="bank_number", type="string", length=34, nullable=true)
     */
    protected $bankNumber = null;

	
	/** company ****************************************************************/

    /**
     * @var integer
     *
     * @ORM\Column(name="legal_form", type="integer", length=1, nullable=false)
     */
    protected $legalForm = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=150, nullable=true)
     */
    protected $companyName = null;

    /**
     * @var string
     *
     * @ORM\Column(name="company_street", type="string", length=150, nullable=true)
     */
    protected $companyStreet = null;

    /**
     * @var string
     *
     * @ORM\Column(name="company_house_number", type="string", length=30, nullable=true)
     */
    protected $companyHouseNumber = null;

    /**
     * @var string
     *
     * @ORM\Column(name="company_zip_code", type="string", length=20, nullable=true)
     */
    protected $companyZipCode = null;

    /**
     * @var string
     *
     * @ORM\Column(name="company_city", type="string", length=250, nullable=true)
     */
    protected $companyCity = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_country_id", type="integer", length=3, nullable=true)
     */
    protected $companyCountryId = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="company_image", type="string", length=255, nullable=true)
     */
    protected $companyImage = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="ico", type="string", length=30, nullable=true)
     */
    protected $ico = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="dic", type="string", length=30, nullable=true)
     */
    protected $dic = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="ic_dph", type="string", length=40, nullable=true)
     */
    protected $icDph = null;
	
	
	/** shipping ****************************************************************/

    /**
     * @var integer
     *
     * @ORM\Column(name="same_as_shipping", type="integer", length=1, nullable=false)
     */
    protected $sameAsShipping = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_first_name", type="string", length=50, nullable=true)
     */
    protected $shippingFirstName = null;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_last_name", type="string", length=50, nullable=true)
     */
    protected $shippingLastName = null;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_street", type="string", length=150, nullable=true)
     */
    protected $shippingStreet = null;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_house_number", type="string", length=30, nullable=true)
     */
    protected $shippingHouseNumber = null;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_zip_code", type="string", length=20, nullable=true)
     */
    protected $shippingZipCode = null;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_city", type="string", length=250, nullable=true)
     */
    protected $shippingCity = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="shipping_country_id", type="integer", length=3, nullable=true)
     */
    protected $shippingCountryId = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="shipping_phone", type="string", length=50, nullable=true)
     */
    protected $shippingPhone = null;
	
	
	/** social ****************************************************************/
	
    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    protected $facebook = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    protected $twitter = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="google_plus", type="string", length=255, nullable=true)
     */
    protected $googlePlus = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="linkedin", type="string", length=255, nullable=true)
     */
    protected $linkedin = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="instagram", type="string", length=255, nullable=true)
     */
    protected $instagram = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="pinterest", type="string", length=255, nullable=true)
     */
    protected $pinterest = null;
	
    /**
     * @var string
     *
     * @ORM\Column(name="tumblr", type="string", length=255, nullable=true)
     */
    protected $tumblr = null;
	
	
	/** getters ****************************************************************/

	public function getId() {
		return $this->id;
	}
	
	public function getImportUserId() {
		return $this->importUserId;
	}
	
	public function getFirstName() {
		return $this->firstName;
	}

	public function getLastName() {
		return $this->lastName;
	}

	public function getSalutation() {
		return $this->salutation;
	}

	public function getDegree() {
		return $this->degree;
	}

	public function getDegreeSuffix() {
		return $this->degreeSuffix;
	}

	public function getBirthdate() {
		return $this->birthdate;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function getWebsite() {
		return $this->website;
	}
	
	public function getAddress() 
	{
		$return = new \stdClass();
		$return->street = $this->street;
		$return->houseNumber = $this->houseNumber;
		$return->zipCode = $this->zipCode;
		$return->city = $this->city;
		$return->countryId = $this->countryId;
		
		return $return;
	}
	
	public function getLegalForm() {
		return $this->legalForm;
	}

	public function getCompany() 
	{
		$return = new \stdClass();
		$return->name = $this->companyName;
		$return->street = $this->companyStreet;
		$return->houseNumber = $this->companyHouseNumber;
		$return->zipCode = $this->companyZipCode;
		$return->city = $this->companyCity;
		$return->countryId = $this->companyCountryId;
		$return->ico = $this->ico;
		$return->dic = $this->dic;
		$return->icDph = $this->icDph;
		
		return $return;
	}
	
	public function isSameAsShipping() {
		return $this->sameAsShipping;
	}
	
	public function getShippingAddress() 
	{
		$return = new \stdClass();
		$return->firstName = $this->shippingFirstName;
		$return->lastName = $this->shippingLastName;
		$return->street = $this->shippingStreet;
		$return->houseNumber = $this->shippingHouseNumber;
		$return->zipCode = $this->shippingZipCode;
		$return->city = $this->shippingCity;
		$return->countryId = $this->shippingCountryId;
		$return->phone = $this->shippingPhone;
		
		return $return;
	}
	
	public function getSocial() 
	{
		$return = new \stdClass();
		$return->facebook = $this->facebook;
		$return->twitter = $this->twitter;
		$return->googlePlus = $this->googlePlus;
		$return->linkedin = $this->linkedin;
		$return->instagram = $this->instagram;
		$return->pinterest = $this->pinterest;
		$return->tumblr = $this->tumblr;
		$return->website = $this->website;
		
		return $return;
	}


}