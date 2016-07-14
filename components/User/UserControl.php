<?php

namespace Wame\UserModule\Components;

use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\UserRepository;

interface IUserControlFactory
{
	/** @return UserControl */
	public function create();	
}


class UserControl extends \Wame\Core\Components\BaseControl
{
	/** @var integer */
	protected $id;
	
	/** @var string */
	protected $slug;
	
	/** @var boolean */
	private $inList = false;
	
	/** @var UserEntity */
	protected $userEntity;
	
	/** @var UserRepository */
	private $userRepository;
	
	/** @var UserEntity */
	private $user;
	
	/** @var string */
	private $lang;
	
	
	public function __construct(UserRepository $userRepository)
    {
		parent::__construct();
		
		$this->userRepository = $userRepository;
		$this->lang = $userRepository->lang;
        
//        $this->getPresenter()->getStatus()->set('meta', 'test');
	}
	
	/**
	 * Render
	 * 
	 * @param UserEntity $userEntity	user
	 */
	public function render($user = null)
	{
        $this->user = $user;
        
        if($this->user === null) {
            $this->user = $this->userRepository->user->getEntity();
        }
		
		$this->template->lang = $this->lang;
		$this->template->user = $this->user;
		
		$this->getTemplateFile();
		$this->template->render();
	}
    
}