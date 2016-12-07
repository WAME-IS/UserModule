<?php

namespace Wame\UserModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Wame\ComponentModule\Registers\IComponent;
use Wame\MenuModule\Models\Item;
use Wame\UserModule\Components\ICompanyControlFactory;


interface ICompanyComponentFactory
{
    /** @return CompanyComponent */
    public function create();
}


class CompanyComponent implements IComponent
{
    /** @var LinkGenerator */
    private $linkGenerator;

    /** @var ICompanyControlFactory */
    private $ICompanyControlFactory;


    public function __construct(
        LinkGenerator $linkGenerator,
        ICompanyControlFactory $ICompanyControlFactory
    ) {
        $this->linkGenerator = $linkGenerator;
        $this->ICompanyControlFactory = $ICompanyControlFactory;
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
        return 'company';
    }


    public function getTitle()
    {
        return _('Company');
    }


    public function getDescription()
    {
        return _('Create company');
    }


    public function getIcon()
    {
        return 'fa fa-list';
    }


    public function getLinkCreate()
    {
        return $this->linkGenerator->link('Admin:CompanyComponent:create');
    }


    public function getLinkDetail($componentEntity)
    {
        return $this->linkGenerator->link('Admin:CompanyComponent:edit', ['id' => $componentEntity->id]);
    }


    public function createComponent()
    {
        $control = $this->ICompanyControlFactory->create();

        return $control;
    }

}