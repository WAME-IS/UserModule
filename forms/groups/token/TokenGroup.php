<?php

namespace Wame\UserModule\Forms\Groups;

use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Groups\BaseGroup;


interface ITokenGroupFactory extends IBaseContainer
{
    /** @return TokenGroup */
    function create();
}


class TokenGroup extends BaseGroup
{
    /** {@inheritDoc} */
    public function getText()
    {
        return _('Token');
    }

}
