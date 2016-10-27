<?php

namespace Wame\UserModule\Vendor\Wame\QuickAddButtonModule\Components\QuickAddButtonControl;

use Nette\Application\LinkGenerator;
use Wame\QuickAddButtonModule\Registers\IQuickAddButton;


interface IUserFactory
{
    /** @return User */
    public function create();
}


class User implements IQuickAddButton
{
	/** @var LinkGenerator */
    private $linkGenerator;


	public function __construct(
        LinkGenerator $linkGenerator
    ) {
        $this->linkGenerator = $linkGenerator;
    }


    /** {@inheritDoc} */
    public function getTitle()
    {
        return _('New user');
    }


    /** {@inheritDoc} */
    public function getIcon()
    {
        return 'person_add';
    }


    /** {@inheritDoc} */
    public function getLink()
    {
        return $this->linkGenerator->link('Admin:User:create');
    }

}
