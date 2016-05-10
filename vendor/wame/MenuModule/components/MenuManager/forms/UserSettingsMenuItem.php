<?php

namespace Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuManager\Forms;

use Nette\Application\LinkGenerator;
use Wame\MenuModule\Models\Item;
use Wame\MenuModule\Models\DatabaseMenuProvider\IMenuItem;
use Wame\MenuModule\Repositories\MenuRepository;

interface IUserSettingsMenuItemFactory
{
	/** @return UserSettingsMenuItem */
	public function create();
}


class UserSettingsMenuItem implements IMenuItem
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
		return 'userSettings';
	}
	
	
	public function getTitle()
	{
		return _('User settings');
	}
	
	
	public function getDescription()
	{
		return _('Insert link to the user settings');
	}
	
	
	public function getIcon()
	{
		return 'fa fa-wrench';
	}
	
	
	public function getLinkCreate($menuId = null)
	{
		return $this->linkGenerator->link('Admin:UserMenuItem:userSettings', ['m' => $menuId]);
	}
	
	
	public function getLinkUpdate($menuEntity)
	{
		return $this->linkGenerator->link('Admin:UserMenuItem:userSettings', ['id' => $menuEntity->id, 'm' => $menuEntity->component->id]);
	}
	
	
	public function getLink($menuEntity)
	{
		return $this->linkGenerator->link('User:UserSettings:', ['lang' => $this->lang]);
	}
	
}
