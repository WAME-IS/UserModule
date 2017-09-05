<?php

namespace Wame\UserModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;

class Dic extends BaseGridItem
{
    /** {@inheritDoc} */
	public function render($grid) {
		$grid->addColumnText('dic', _('Tax ID'))
                ->setSortable()
				->setFilterText();
                
		return $grid;
	}
    
}