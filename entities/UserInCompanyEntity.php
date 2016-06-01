<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\UserModule\Entities\Columns\Company;

/**
 * @ORM\Table(name="wame_user_in_company")
 * @ORM\Entity
 */
class UserInCompanyEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;
	use Columns\CreateDate;
	use Columns\User;
	use Company;

}