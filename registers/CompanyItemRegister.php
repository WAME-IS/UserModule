<?php

namespace Wame\UserModule\Registers;

use Wame\Core\Entities\BaseEntity;


class CompanyItemRegister extends \Wame\Core\Registers\BaseRegister
{
    public function __construct()
    {
        parent::__construct(BaseEntity::class);
    }

}
