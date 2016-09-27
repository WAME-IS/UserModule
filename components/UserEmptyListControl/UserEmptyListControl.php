<?php

namespace Wame\UserModule\Components;

use Nette\ComponentModel\IContainer;
use Nette\DI\Container;
use Wame\UserModule\Repositories\UserRepository;
use Wame\ListControl\Components\EmptyListControl;

interface IUserEmptyListControlFactory
{
    /** @return UserEmptyListControl */
    public function create();
}

class UserEmptyListControl extends EmptyListControl
{
    /** @var UserRepository */
    private $userRepository;

    
    public function __construct(
        Container $container, 
        UserRepository $userRepository, 
        IContainer $parent = NULL, 
        $name = NULL
    ) {
        parent::__construct($container, $parent, $name);
        $this->userRepository = $userRepository;
    }

    protected function create()
    {
        $this->getPresenter()->redirect(":User:user:");
    }
}
