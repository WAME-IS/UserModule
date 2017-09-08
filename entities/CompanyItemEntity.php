<?php

namespace Wame\UserModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\UserModule\Entities\Columns\Company;


/**
 * @ORM\Table(name="wame_company_item")
 * @ORM\Entity
 */
class CompanyItemEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;
    use Columns\Type;
    use Columns\ValueId;
    use Company;

}
