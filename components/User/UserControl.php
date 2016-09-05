<?php

namespace Wame\UserModule\Components;

use Nette\DI\Container;
use Wame\Core\Components\BaseControl;
use Wame\UserModule\Entities\UserEntity;

interface IUserControlFactory
{

    /** @return UserControl */
    public function create();
}

class UserControl extends BaseControl
{
    public function __construct(
        Container $container
    ) {
        parent::__construct($container);

//        $this->getStatus()->set(UserEntity::class, $this->user->getEntity());
    }

    public function render(UserEntity $userEntity = null)
    {
        if (!$userEntity) {
            $userEntity = $this->getStatus()->get(UserEntity::class);
        }
        
        if (!$userEntity && $this->user->isLoggedIn()) {
            $userEntity = $this->user->getEntity();
            
            $this->getStatus()->set(UserEntity::class, $userEntity);
        }
        
        $this->template->profile = $userEntity;
    }
    
}
