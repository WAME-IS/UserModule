<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridColumn;

class LastLoginGridColumn extends BaseGridColumn
{
	public function addColumn($grid) {
		$grid->addColumnDateTime('lastLogin', _('Last login'))
                ->setFormat('d.m.Y - H:i:s')
				->setSortable()
				->setFilterDate();
		
		return $grid;
	}
    
}