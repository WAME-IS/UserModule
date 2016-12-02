<?php

namespace Wame\UserModule\Components;

use Nette\Security\User;
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
    public function __construct(\Nette\DI\Container $container, User $user, $entity = null)
    {
        // if not provided and logged, set entity to logged user
        if(!$entity && $user) {
            $entity = $user->getEntity();
        }

        parent::__construct($container, $entity);
    }


    /** {@inheritDoc} */
    protected function getEntityType()
    {
        return UserEntity::class;
    }

}
