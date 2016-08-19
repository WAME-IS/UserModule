<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;

class LastLogin extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addColumnDateTime('lastLogin', _('Last login'))
                ->setFormat('d.m.Y - H:i:s')
				->setSortable()
				->setFilterDate();
		
		return $grid;
	}
    
}