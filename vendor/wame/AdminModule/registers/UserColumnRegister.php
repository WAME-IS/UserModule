<?php

namespace Wame\UserModule\Vendor\Wame\Registers;

use Wame\Core\Registers\BaseRegister;

class UserColumnRegister extends BaseRegister
{
    public function __construct()
    {
        parent::__construct(CategoryType::class);
    }
    
}