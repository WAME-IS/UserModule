<?php

namespace App\AdminModule\Presenters;

use Wame\Core\Presenters\Traits\UseParentTemplates;


class CompanyListComponentPresenter extends AbstractComponentPresenter
{
    use UseParentTemplates;


    protected function getComponentIdentifier()
    {
        return 'CompanyListComponent';
    }


    protected function getComponentName()
    {
        return _('Company list');
    }

}
