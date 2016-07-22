<?php

namespace Wame\UserModule\Components;

use Nette\DI\Container;
use Nette\Security\User;
use Wame\Core\Components\BaseControl;
use Wame\ComponentModule\Components\IPositionControlFactory;
use Wame\UserModule\Entities\UserEntity;

interface IUserControlFactory
{

    /** @return UserControl */
    public function create();
}

class UserControl extends BaseControl
{

    /** @var integer */
    protected $id;

    /** @var UserEntity */
    protected $userEntity;

    /** @var IPositionControlFactory */
    private $IPositionControlFactory;
    private $user;

    public function __construct(
    Container $container, User $user, IPositionControlFactory $IPositionControlFactory
    )
    {
        parent::__construct($container);

        $this->user = $user;

        $this->IPositionControlFactory = $IPositionControlFactory;

        $this->getStatus()->set('user', $this->user->getEntity());
    }

    /**
     * Render
     * 
     * @param UserEntity $userEntity	user
     */
    public function render(UserEntity $userEntity = null)
    {
        if ($userEntity) {
            $this->user = $userEntity;
        }

        $this->template->user = $this->user;

        $this->getTemplateFile();
        $this->template->render();
    }
}
