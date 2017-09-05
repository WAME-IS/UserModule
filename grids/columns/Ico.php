<?php

namespace Wame\UserModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;

class Ico extends BaseGridItem
{
    /** {@inheritDoc} */
	public function render($grid) {
		$grid->addColumnText('ico', _('Business ID'))
                ->setSortable()
				->setFilterText();
                
		return $grid;
	}
    
}