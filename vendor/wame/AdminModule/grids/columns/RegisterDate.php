<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\Columns;

use Nette\Utils\Html;
use Wame\DataGridControl\BaseGridItem;
use Wame\Utils\Date;


class RegisterDate extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addColumnDateTime('registerDate', _('Register date'))
                ->setFormat('d.m.Y H:i')
                ->setRenderer(function($user) {
                    $date = $user->getRegisterDate();

                    return Html::el('div')->setText(Date::toString($date, 'd.m.Y')) . Html::el('small')->setText(Date::toString($date, 'H:i:s'));
                })
                ->setTemplateEscaping(false)
				->setSortable()
				->setFilterDate();

		return $grid;
	}

}