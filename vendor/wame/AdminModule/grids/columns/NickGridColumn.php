<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridColumn;

class NickGridColumn extends BaseGridColumn
{
	public function addColumn($grid) {
		$grid->addColumnText('nick', _('Nick'))
                ->setSortable()
				->setFilterText();
                
		return $grid;
	}
    
}