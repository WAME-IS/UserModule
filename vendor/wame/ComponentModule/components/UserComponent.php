<?php

namespace Wame\UserModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Wame\ComponentModule\Models\IComponent;
use Wame\MenuModule\Models\Item;
use Wame\UserModule\Components\IUserControlFactory;

interface IUserComponentFactory
{
    /** @return UserComponent */
    public function create();   
}


class UserComponent implements IComponent
{   
    /** @var LinkGenerator */
    private $linkGenerator;

    /** @var IUserControlFactory */
    private $IUserControlFactory;


    public function __construct(
        LinkGenerator $linkGenerator,
        IUserControlFactory $IUserControlFactory
    ) {
        $this->linkGenerator = $linkGenerator;
        $this->IUserControlFactory = $IUserControlFactory;
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
        return 'user';
    }


    public function getTitle()
    {
        return _('User');
    }


    public function getDescription()
    {
        return _('Create user');
    }


    public function getIcon()
    {
        return 'fa fa-user';
    }


    public function getLinkCreate()
    {
        return $this->linkGenerator->link('Admin:UserControl:create');
    }


    public function getLinkDetail($componentEntity)
    {
        return $this->linkGenerator->link('Admin:UserControl:edit', ['id' => $componentEntity->id]);
    }


    public function createComponent($componentInPosition)
    {
        $control = $this->IUserControlFactory->create();
        $control->setComponentInPosition($componentInPosition);

        return $control;
    }

}