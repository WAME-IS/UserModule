<?php

namespace App\AdminModule\Presenters;

use Wame\Core\Presenters\Traits\UseParentTemplates;


class SignInFormComponentPresenter extends AbstractComponentPresenter
{	
    use UseParentTemplates;
    
    
    protected function getComponentIdentifier()
    {
        return 'SignInFormComponent';
    }
    
    
    protected function getComponentName()
    {
        return _('Sign in form');
    }
 
}
