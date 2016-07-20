<?php

namespace Wame\UserModule\Components;

use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\UserRepository;
use Wame\PositionModule\Components\IPositionControlFactory;
use Nette\Security\User;

interface IUserControlFactory
{
	/** @return UserControl */
	public function create();	
}


class UserControl extends \Wame\Core\Components\BaseControl
{
	/** @var integer */
	protected $id;
	
	/** @var UserEntity */
	protected $userEntity;
    
    /** @var IPositionControlFactory */
    private $IPositionControlFactory;
    
    private $user;
	
	
	public function __construct(
        User $user, 
        IPositionControlFactory $IPositionControlFactory
    ) {
		parent::__construct();
		
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
        if($userEntity) {
            $this->user = $userEntity;
        }

        
        
        $this->template->user = $this->user;

        $this->getTemplateFile();
        $this->template->render();
	}
    
    
    /**
     * Position control
     * 
     * @return IPositionControlFactory
     */
    protected function createComponentPositionControl()
    {
        $control = $this->IPositionControlFactory->create();

        return $control;
    }
    
}