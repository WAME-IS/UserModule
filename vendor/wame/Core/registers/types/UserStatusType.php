<?php

namespace Wame\UserModule\Vendor\Wame\Core\Registers\Types;

class UserStatusType implements \Wame\Core\Registers\Types\IStatusType
{
    public function getStatusName()
    {
        return "user";
    }

    public function getTitle()
    {
        return _('User');
    }
    
}
