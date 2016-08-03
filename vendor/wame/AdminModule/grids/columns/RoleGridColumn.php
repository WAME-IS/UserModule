<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridColumn;

class RoleGridColumn extends BaseGridColumn
{
	public function addColumn($grid) {
		$grid->addColumnText('role', _('Role'))
                ->setSortable()
				->setFilterText();
                
		return $grid;
	}
    
}