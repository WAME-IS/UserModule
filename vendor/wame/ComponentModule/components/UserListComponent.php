<?php

namespace Wame\UserModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Wame\ComponentModule\Registers\IComponent;
use Wame\MenuModule\Models\Item;
use Wame\UserModule\Components\IUserListControlFactory;

interface IUserListComponentFactory
{
    /** @return UserListComponent */
    public function create();   
}


class UserListComponent implements IComponent
{   
    /** @var LinkGenerator */
    private $linkGenerator;

    /** @var IUserListControlFactory */
    private $IUserListControlFactory;


    public function __construct(
        LinkGenerator $linkGenerator,
        IUserListControlFactory $IUserListControlFactory
    ) {
        $this->linkGenerator = $linkGenerator;
        $this->IUserListControlFactory = $IUserListControlFactory;
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
        return 'userList';
    }


    public function getTitle()
    {
        return _('User list');
    }


    public function getDescription()
    {
        return _('Create user list');
    }


    public function getIcon()
    {
        return 'fa fa-users';
    }


    public function getLinkCreate()
    {
        return $this->linkGenerator->link('Admin:UserListControl:create');
    }


    public function getLinkDetail($componentEntity)
    {
        return $this->linkGenerator->link('Admin:UserListControl:edit', ['id' => $componentEntity->id]);
    }


    public function createComponent()
    {
        $control = $this->IUserListControlFactory->create();
        return $control;
    }

}