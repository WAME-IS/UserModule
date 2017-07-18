<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\BaseEntity;
use Wame\Core\Entities\Columns;


/**
 * @ORM\Table(name="wame_token")
 * @ORM\Entity
 */
class TokenEntity extends BaseEntity
{
	use Columns\Identifier;
	use Columns\Token;
	use Columns\ExpireDate;


    /**
     * @ORM\OneToOne(targetEntity="Wame\UserModule\Entities\UserEntity", inversedBy="token")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /** get ************************************************************/

    public function getUser()
    {
        return $this->user;
    }


    /** set ************************************************************/

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

}
