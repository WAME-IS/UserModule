<?php

namespace App\AdminModule\Presenters;

use Wame\Core\Presenters\Traits\UseParentTemplates;


class SignUpFormComponentPresenter extends AbstractComponentPresenter
{	
    use UseParentTemplates;
    
    
    protected function getComponentIdentifier()
    {
        return 'SignUpFormComponent';
    }
    
    
    protected function getComponentName()
    {
        return _('Sign up form');
    }
 
}
