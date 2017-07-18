<?php

namespace App\AdminModule\Presenters;

use Wame\Core\Presenters\Traits\UseParentTemplates;


class PasswordForgotFormComponentPresenter extends AbstractComponentPresenter
{	
    use UseParentTemplates;
    
    
    protected function getComponentIdentifier()
    {
        return 'PasswordForgotFormComponent';
    }
    
    
    protected function getComponentName()
    {
        return _('Password forgot form');
    }
 
}
