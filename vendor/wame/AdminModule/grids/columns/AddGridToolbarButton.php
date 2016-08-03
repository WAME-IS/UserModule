<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

class AddGridToolbarButton extends \Wame\DataGridControl\BaseGridColumn
{
	public function addColumn($grid)
    {
        $grid->addToolbarButton(":{$grid->presenter->getName()}:create", _('Create user'))
                ->setIcon('fa fa-plus')
                ->setClass('btn btn-success');
                
		return $grid;
	}
}