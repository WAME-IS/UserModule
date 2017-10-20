<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Commands;

use Wame\ComponentModule\Commands\CreatePositionCommand;


class PositionAdminUserRightPanelCommand extends CreatePositionCommand
{
    /** {@inheritdoc} */
    protected function getPositionName()
    {
        return 'adminUserRightPanel';
    }


    /** {@inheritdoc} */
    protected function getPositionTitle()
    {
        return _('Admin user right panel');
    }


    /** {@inheritdoc} */
    protected function getPositionDescription()
    {
        return null;
    }


    /** {@inheritdoc} */
    protected function getPositionParameters()
    {
        return [
            'container' => [
                'tag' => ''
            ]
        ];
    }


    /** {@inheritdoc} */
    protected function inList()
    {
        return false;
    }

}
