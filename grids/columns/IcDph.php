<?php

namespace Wame\UserModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;

class IcDph extends BaseGridItem
{
    /** {@inheritDoc} */
	public function render($grid) {
		$grid->addColumnText('icDph', _('IcDph'))
                ->setSortable()
				->setFilterText();
                
		return $grid;
	}
    
}