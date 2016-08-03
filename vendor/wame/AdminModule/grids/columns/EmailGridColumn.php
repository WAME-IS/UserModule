<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridColumn;

class EmailGridColumn extends BaseGridColumn
{
	public function addColumn($grid) {
		$grid->addColumnText('email', _('Email'))
                ->setSortable()
				->setFilterText();
                
		return $grid;
	}
    
}