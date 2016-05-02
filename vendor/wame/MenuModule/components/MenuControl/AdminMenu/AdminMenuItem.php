<?php

namespace Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuControl\AdminMenu;

use Wame\MenuModule\Models\Item;

class AdminMenuItem
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
		$item->setName('user');
		$item->setPriority(1);
		$item->setTitle(_('Users'));
		$item->setLink($this->linkGenerator->link('Admin:User:', ['id' => null]));
		$item->setIcon('fa fa-users');
		
		$item->addNode($this->usersDefault(), 'users');
		
		return $item->getItem();
	}
	
	private function usersDefault()
	{
		$item = new Item();
		$item->setName('user-users');
		$item->setTitle(_('Users'));
		$item->setLink($this->linkGenerator->link('Admin:User:', ['id' => null]));
		
		return $item->getItem();
	}

}
