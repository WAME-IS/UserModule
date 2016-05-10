<?php

namespace Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuManager\Forms;

use Nette\Application\LinkGenerator;
use Wame\MenuModule\Models\Item;
use Wame\MenuModule\Models\DatabaseMenuProvider\IMenuItem;
use Wame\MenuModule\Repositories\MenuRepository;

interface ISignOutMenuItemFactory
{
	/** @return SignOutMenuItem */
	public function create();
}


class SignOutMenuItem implements IMenuItem
{	
    /** @var LinkGenerator */
	private $linkGenerator;
	
    /** @var string */
	private $lang;
	
	
	public function __construct(
		LinkGenerator $linkGenerator,
		MenuRepository $menuRepository
	) {
		$this->linkGenerator = $linkGenerator;
		$this->lang = $menuRepository->lang;
	}

	
	public function addItem()
	{
		$item = new Item();
		$item->setName($this->getName());
		$item->setTitle($this->getTitle());
		$item->setDescription($this->getDescription());
		$item->setLink($this->getLinkCreate());
		$item->setIcon($this->getIcon());
		
		return $item->getItem();
	}

	
	public function getName()
	{
		return 'signOut';
	}
	
	
	public function getTitle()
	{
		return _('Sign out');
	}
	
	
	public function getDescription()
	{
		return _('Insert link to the user sign out');
	}
	
	
	public function getIcon()
	{
		return 'fa fa-sign-out';
	}
	
	
	public function getLinkCreate($menuId = null)
	{
		return $this->linkGenerator->link('Admin:UserMenuItem:signOut', ['m' => $menuId]);
	}
	
	
	public function getLinkUpdate($menuEntity)
	{
		return $this->linkGenerator->link('Admin:UserMenuItem:signOut', ['id' => $menuEntity->id, 'm' => $menuEntity->component->id]);
	}
	
	
	public function getLink($menuEntity)
	{
		return $this->linkGenerator->link(':User:Sign:out', ['lang' => $this->lang]);
	}
	
}
