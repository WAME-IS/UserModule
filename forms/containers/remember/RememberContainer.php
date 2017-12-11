<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;


interface IRememberContainerFactory extends IBaseContainer
{
    /** @return RememberContainer */
    public function create();
}


class RememberContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
    {
        $this->addCheckbox('remember', _('Remember me'));
    }

}
