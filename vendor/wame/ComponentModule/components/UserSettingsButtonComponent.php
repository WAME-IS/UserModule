<?php

namespace Wame\UserModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Wame\ComponentModule\Registers\IComponent;
use Wame\MenuModule\Models\Item;
use Wame\UserModule\Components\IUserSettingsButtonControlFactory;


interface IUserSettingsButtonComponentFactory
{
    /** @return UserSettingsButtonComponent */
    public function create();   
}


class UserSettingsButtonComponent implements IComponent
{   
    /** @var LinkGenerator */
    private $linkGenerator;

    /** @var IUserSettingsButtonControlFactory */
    private $IUserSettingsButtonControlFactory;


    public function __construct(
        LinkGenerator $linkGenerator,
        IUserSettingsButtonControlFactory $IUserSettingsButtonControlFactory
    ) {
        $this->linkGenerator = $linkGenerator;
        $this->IUserSettingsButtonControlFactory = $IUserSettingsButtonControlFactory;
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
        return 'userSettingsButton';
    }


    public function getTitle()
    {
        return _('User settings button');
    }


    public function getDescription()
    {
        return _('Create user settings button');
    }


    public function getIcon()
    {
        return 'fa fa-wrench';
    }


    public function getLinkCreate()
    {
        return $this->linkGenerator->link('Admin:UserSettingsButtonComponent:create');
    }


    public function getLinkDetail($componentEntity)
    {
        return $this->linkGenerator->link('Admin:UserSettingsButtonComponent:edit', ['id' => $componentEntity->id]);
    }


    public function createComponent()
    {
        $control = $this->IUserSettingsButtonControlFactory->create();

        return $control;
    }

}