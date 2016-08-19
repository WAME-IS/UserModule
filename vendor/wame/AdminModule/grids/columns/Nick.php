<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;

class Nick extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addColumnText('nick', _('Nick'))
                ->setSortable()
				->setFilterText();
                
		return $grid;
	}
    
}