<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Components\AdminMenuControl;

use Wame\AdminModule\Components\AdminMenuControl\Item;

class AdminMenuControl
{	
	/** @var \Nette\Application\LinkGenerator */
	private $linkGenerator;
	
	public function __construct($linkGenerator)
	{
		$this->linkGenerator = $linkGenerator;
	}
	
	public function addItem()
	{
		$item = new Item();
		$item->setTitle(_('Užívatelia'));
		$item->setLink($this->linkGenerator->link('Admin:Users:', ['id' => null]));
		$item->setIcon('fa fa-users');
		
		$item->addChild($this->usersDefault());
		$item->addChild($this->userAdd());
		
		return $item->getItem();
	}
	
	private function usersDefault()
	{
		$item = new Item();
		$item->setTitle(_('Užívatelia'));
		$item->setLink($this->linkGenerator->link('Admin:Users:', ['id' => null]));
		
		return $item->getItem();
	}
	
	private function userAdd()
	{
		$item = new Item();
		$item->setTitle(_('Pridať užívateľa'));
		$item->setLink($this->linkGenerator->link('Admin:User:add', ['id' => null]));
		
		return $item->getItem();
	}

}
