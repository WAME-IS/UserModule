<?php

namespace Wame\UserModule\Forms\Actions;

use Wame\DynamicObject\Forms\Actions\BaseAction;
use Wame\DynamicObject\Registers\Types\IBaseAction;
use Wame\Utils\Date;


interface IRegisterDateActionFactory extends IBaseAction
{
	/** @return RegisterDateAction */
	public function create();
}


class RegisterDateAction extends BaseAction
{
    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setRegisterDate(Date::toDateTime(Date::NOW));
    }

}
