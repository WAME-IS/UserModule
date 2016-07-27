<?php

namespace Wame\UserModule\Components;

use Nette\Application\LinkGenerator;
use Nette\DI\Container;
use Wame\Core\Components\BaseControl;


interface IUserSettingsButtonControlFactory
{
	/** @return UserSettingsButtonControl */
	public function create();
}


class UserSettingsButtonControl extends BaseControl
{
    /** @var LinkGenerator */
    private $linkGenerator;


    public function __construct(
        Container $container, 
        LinkGenerator $linkGenerator
    ) {
        parent::__construct($container);
                
        $this->linkGenerator = $linkGenerator;
    }


    public function render()
    {
        $this->template->link = $this->linkGenerator->link('User:Settings:');
    }

}
