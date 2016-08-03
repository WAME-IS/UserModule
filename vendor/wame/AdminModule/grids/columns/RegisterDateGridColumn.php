<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridColumn;

class RegisterDateGridColumn extends BaseGridColumn
{
	public function addColumn($grid) {
		$grid->addColumnDateTime('registerDate', _('Register date'))
                ->setFormat('d.m.Y - H:i:s')
				->setSortable()
				->setFilterDate();
		
		return $grid;
	}
    
}