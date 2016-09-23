<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\ToolbarButtons;

use Wame\AdminModule\Vendor\Wame\DataGridControl\ToolbarButtons\Add as AdminAdd;


class AddUser extends AdminAdd
{
    public function __construct() 
    {
        $this->setTitle(_('Create user'));
    }

}