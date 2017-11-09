<?php

namespace Wame\UserModule\Components;

use Nette\ComponentModel\IContainer;
use Nette\DI\Container;
use Wame\UserModule\Entities\UserEntity;
use Wame\ChameleonComponents\IO\DataLoaderControl;
use Wame\ChameleonComponentsListControl\Components\ChameleonListControl;


interface IUserListControlFactory
{
    /** @return UserListControl */
    public function create();
}


class UserListControl extends ChameleonListControl implements DataLoaderControl
{
    public function __construct(
        Container $container, 
        IUserControlFactory $IUserControlFactory, 
        IUserEmptyListControlFactory $IUserEmptyListControlFactory, 
        IContainer $parent = NULL, 
        $name = NULL
    ) {
        parent::__construct($container, $parent, $name);

        $this->setComponentFactory($IUserControlFactory);
        $this->setNoItemsFactory($IUserEmptyListControlFactory);
    }

    
    /** {@inheritDoc} */
    public function getListType()
    {
        return UserEntity::class;
    }

}
