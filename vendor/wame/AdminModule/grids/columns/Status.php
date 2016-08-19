<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

class Status extends \Wame\DataGridControl\Columns\Status
{
	/** {@inheritDoc} */
	public function render($grid)
	{
        $this->grid = $grid;
        
		$grid->addColumnStatus('status', _('Status'))
				->addOption(1, _('Active'))
					->setIcon('check')
					->setClass('btn-success')
					->endOption()
				->addOption(2, _('Email activation'))
					->setIcon('close')
					->setClass('btn-info')
					->endOption()
				->onChange[] = [$this, 'statusChange'];
		
		return $grid;
	}
    
}