<?php

namespace Wame\UserModule\Components;

use Nette\DI\Container;
use Wame\Core\Components\BaseControl;

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

//        $this->getStatus()->set('user', $this->user->getEntity());
    }

    public function render(UserEntity $userEntity = null)
    {
        if (!$userEntity) {
            $userEntity = $this->getStatus()->get('user');
        }
        
        if (!$userEntity && $this->user->isLoggedIn()) {
            $userEntity = $this->user->getEntity();
            $this->getStatus()->set('user', $userEntity);
        }
        
        $this->template->profile = $userEntity;
    }
    
}
