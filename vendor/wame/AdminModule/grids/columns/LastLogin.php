<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Nette\Utils\Html;
use Wame\DataGridControl\BaseGridItem;
use Wame\Utils\Date;


class LastLogin extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addColumnDateTime('lastLogin', _('Last login'))
                ->setFormat('d.m.Y H:i')
                ->setRenderer(function($user) {
                    $date = $user->getLastLogin();

                    return Html::el('div')->setText(Date::toString($date, 'd.m.Y')) . Html::el('small')->setText(Date::toString($date, 'H:i:s'));
                })
                ->setTemplateEscaping(false)
				->setSortable()
				->setFilterDate();

		return $grid;
	}

}
