<?php

namespace Wame\UserModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Nette\DI\Container;
use Wame\ComponentModule\Registers\IComponent;
use Wame\MenuModule\Models\Item;


interface IPasswordForgotFormComponentFactory
{
    /** @return PasswordForgotFormComponent */
    public function create();   
}


class PasswordForgotFormComponent implements IComponent
{   
    /** @var LinkGenerator */
    private $linkGenerator;

    /** @var Container */
    private $container;


    public function __construct(
        LinkGenerator $linkGenerator,
        Container $container
    ) {
        $this->linkGenerator = $linkGenerator;
        $this->container = $container;
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
        return 'passwordForgotForm';
    }


    public function getTitle()
    {
        return _('Password forgot form');
    }


    public function getDescription()
    {
        return _('Create password forgot form');
    }


    public function getIcon()
    {
        return 'fa fa-list-alt';
    }


    public function getLinkCreate()
    {
        return $this->linkGenerator->link('Admin:PasswordForgotFormComponent:create');
    }


    public function getLinkDetail($componentEntity)
    {
        return $this->linkGenerator->link('Admin:PasswordForgotFormComponent:edit', ['id' => $componentEntity->id]);
    }


    public function createComponent()
    {
        return $this->container
                    ->getService('PasswordForgotFormBuilder')
                    ->build();
    }

}