<?php

namespace Wame\UserModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Nette\DI\Container;
use Wame\ComponentModule\Registers\IComponent;
use Wame\MenuModule\Models\Item;


interface ISignUpFormComponentFactory
{
    /** @return SignUpFormComponent */
    public function create();   
}


class SignUpFormComponent implements IComponent
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
        return 'signUpForm';
    }


    public function getTitle()
    {
        return _('Sign up form');
    }


    public function getDescription()
    {
        return _('Create sign up form');
    }


    public function getIcon()
    {
        return 'fa fa-list-alt';
    }


    public function getLinkCreate()
    {
        return $this->linkGenerator->link('Admin:SignUpFormComponent:create');
    }


    public function getLinkDetail($componentEntity)
    {
        return $this->linkGenerator->link('Admin:SignUpFormComponent:edit', ['id' => $componentEntity->id]);
    }


    public function createComponent()
    {
        return $this->container
                    ->getService('UserSignUpFormBuilder')
                    ->build();
    }

}