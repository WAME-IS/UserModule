<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;

class RegisterDate extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addColumnDateTime('registerDate', _('Register date'))
                ->setFormat('d.m.Y - H:i:s')
				->setSortable()
				->setFilterDate();
		
		return $grid;
	}
    
}