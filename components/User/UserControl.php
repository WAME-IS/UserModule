<?php

namespace Wame\UserModule\Components;

use Wame\UserModule\Entities\UserEntity;
use Wame\ChameleonComponents\Components\SingleEntityControl;
use Wame\ListControl\Components\IEntityControlFactory;

interface IUserControlFactory extends IEntityControlFactory
{
    /** @return UserControl */
    public function create($entity = null);
}

class UserControl extends SingleEntityControl
{
    protected function getEntityType()
    {
        return UserEntity::class;
    }
    
}
