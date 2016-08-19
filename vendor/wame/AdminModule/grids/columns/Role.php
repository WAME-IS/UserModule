<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;

class Role extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addColumnText('role', _('Role'))
                ->setSortable()
				->setFilterText();
                
		return $grid;
	}
    
}