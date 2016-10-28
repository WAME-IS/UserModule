<?php

namespace App\AdminModule\Presenters;

use Wame\Core\Presenters\Traits\UseParentTemplates;


class UserListControlPresenter extends AbstractComponentPresenter
{	
    use UseParentTemplates;
    
    
    protected function getComponentIdentifier()
    {
        return 'UserListComponent';
    }
    
    
    protected function getComponentName()
    {
        return _('User list component');
    }
 
}
