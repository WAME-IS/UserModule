<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;

class Email extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addColumnText('email', _('Email'))
                ->setSortable()
				->setFilterText();
                
		return $grid;
	}
    
}