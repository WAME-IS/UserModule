<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use \Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_user_info")
 * @ORM\Entity
 */
class UserInfoEntity extends \Wame\Core\Entities\BaseEntity
{	
	use Columns\Identifier;

    /**
     * @ORM\Column(name="import_user_id", type="integer", nullable=true)
     */
    protected $importUserId = null;

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
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    protected $birthdate = null;

    /**
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    protected $text = null;
	
}