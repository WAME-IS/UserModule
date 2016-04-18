<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="wame_user")
 * @ORM\Entity
 */
class UserEntity extends \Wame\Core\Entities\BaseEntity
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
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=2, nullable=true)
     */
    protected $lang = 'sk';

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=64, nullable=true)
     */
    protected $token = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="referal_id", type="integer", length=11, nullable=true)
     */
    protected $referalId = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="partner_project_id", type="integer", length=11, nullable=true)
     */
    protected $partnerProjectId = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="currency_id", type="integer", length=3, nullable=true)
     */
    protected $currencyId = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="price_group_id", type="integer", length=2, nullable=true)
     */
    protected $priceGroupId = null;

   /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=20, nullable=false)
     */
    protected $role = 'contact';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64, nullable=false)
     */
    protected $password;
 
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    protected $email;
 
    /**
     * @var string
     *
     * @ORM\Column(name="nick", type="string", length=30, nullable=true)
     */
    protected $nick = null;
 
    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=150, nullable=true)
     */
    protected $fullName = null;
 
    /**
     * @var datetime
     *
     * @ORM\Column(name="register_date", type="datetime", nullable=false)
     */
    protected $registerDate;
 
    /**
     * @var datetime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=false)
     */
    protected $lastLogin;
 
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    protected $image = null;
 
    /**
     * @var float
     *
     * @ORM\Column(name="credit", type="float", nullable=false)
     */
    protected $credit = 0;
 
    /**
     * @var float
     *
     * @ORM\Column(name="rating", type="float", nullable=false)
     */
    protected $rating = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="email_status", type="integer", nullable=false)
     */
    protected $emailStatus = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="sms_status", type="integer", nullable=false)
     */
    protected $smsStatus = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    protected $status = '1';


	/**
	 * @ORM\ManyToOne(targetEntity="UserInfoEntity")
	 * @ORM\JoinColumn(name="user_info_id", referencedColumnName="id", nullable=false)
	 */
    protected $userInfo;

}