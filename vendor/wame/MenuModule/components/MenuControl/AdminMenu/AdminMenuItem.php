<?php

namespace Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuControl\AdminMenu;

use Wame\MenuModule\Models\Item;

class AdminMenuItem
{	
	public $name = 'user';
			
	/** @var \Nette\Application\LinkGenerator */
	private $linkGenerator;
	
	public function __construct($linkGenerator)
	{
		$this->linkGenerator = $linkGenerator;
	}
	
	public function addItem()
	{
		$item = new Item();
		$item->setTitle(_('Users'));
		$item->setLink($this->linkGenerator->link('Admin:User:', ['id' => null]));
		$item->setIcon('fa fa-users');
		
		$item->addNode($this->usersDefault(), 'users');
		$item->addNode($this->userAdd(), 'addUser');
		
		return $item->getItem();
	}
	
	private function usersDefault()
	{
		$item = new Item();
		$item->setTitle(_('Users'));
		$item->setLink($this->linkGenerator->link('Admin:User:', ['id' => null]));
		
		return $item->getItem();
	}
	
	private function userAdd()
	{
		$item = new Item();
		$item->setTitle(_('Add user'));
		$item->setLink($this->linkGenerator->link('Admin:User:create', ['id' => null]));
		
		return $item->getItem();
	}

}
