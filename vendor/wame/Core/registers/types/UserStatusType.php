<?php

namespace Wame\UserModule\Vendor\Wame\Core\Registers\Types;

class UserStatusType extends \Wame\Core\Registers\Types\StatusType
{

    public function getTitle()
    {
        return _('User');
    }
    
    public function getEntityName()
    {
        return \Wame\UserModule\Entities\UserEntity::class;
    }
    
}
