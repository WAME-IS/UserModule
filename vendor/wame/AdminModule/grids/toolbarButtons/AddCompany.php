<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\ToolbarButtons;

use Wame\AdminModule\Vendor\Wame\DataGridControl\ToolbarButtons\Add as AdminAdd;


class AddCompany extends AdminAdd
{
    public function __construct() 
    {
        $this->setTitle(_('Create company'));
        $this->isAjaxModal(null, true);
    }

}