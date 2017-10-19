<?php

namespace Wame\UserModule\Vendor\Wame\Core\Registers\Types;


class CompanyStatusType extends \Wame\Core\Registers\Types\StatusType
{
    /** {@inheritDoc} */
    public function getTitle()
    {
        return _('Company');
    }


    /** {@inheritDoc} */
    public function getEntityName()
    {
        return \Wame\UserModule\Entities\CompanyEntity::class;
    }
    
}
