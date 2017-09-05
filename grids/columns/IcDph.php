<?php

namespace Wame\UserModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;

class IcDph extends BaseGridItem
{
    /** {@inheritDoc} */
	public function render($grid) {
		$grid->addColumnText('icDph', _('VAT reg. no.'))
                ->setSortable()
				->setFilterText();
                
		return $grid;
	}
    
}