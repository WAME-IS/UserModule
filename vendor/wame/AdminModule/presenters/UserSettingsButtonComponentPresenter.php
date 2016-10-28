<?php

namespace App\AdminModule\Presenters;

use Wame\Core\Presenters\Traits\UseParentTemplates;


class UserSettingsButtonComponentPresenter extends AbstractComponentPresenter
{	
    use UseParentTemplates;
    
    
    protected function getComponentIdentifier()
    {
        return 'UserSettingsButtonComponent';
    }
    
    
    protected function getComponentName()
    {
        return _('User settings button');
    }
 
}
