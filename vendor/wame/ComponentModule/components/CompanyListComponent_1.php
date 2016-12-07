<?php

namespace Wame\UserModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Wame\ComponentModule\Registers\IComponent;
use Wame\MenuModule\Models\Item;
use Wame\UserModule\Components\ICompanyListControlFactory;


interface ICompanyListComponentFactory
{
    /** @return CompanyListComponent */
    public function create();
}


class CompanyListComponent implements IComponent
{
    /** @var LinkGenerator */
    private $linkGenerator;

    /** @var ICompanyListControlFactory */
    private $ICompanyListControlFactory;


    public function __construct(
        LinkGenerator $linkGenerator,
        ICompanyListControlFactory $ICompanyListControlFactory
    ) {
        $this->linkGenerator = $linkGenerator;
        $this->ICompanyListControlFactory = $ICompanyListControlFactory;
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
        return 'companyList';
    }


    public function getTitle()
    {
        return _('Company list');
    }


    public function getDescription()
    {
        return _('Create company list');
    }


    public function getIcon()
    {
        return 'fa fa-list';
    }


    public function getLinkCreate()
    {
        return $this->linkGenerator->link('Admin:CompanyListComponent:create');
    }


    public function getLinkDetail($componentEntity)
    {
        return $this->linkGenerator->link('Admin:CompanyListComponent:edit', ['id' => $componentEntity->id]);
    }


    public function createComponent()
    {
        $control = $this->ICompanyListControlFactory->create();

        return $control;
    }

}