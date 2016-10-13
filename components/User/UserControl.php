<?php

namespace Wame\UserModule\Components;

use Wame\UserModule\Entities\UserEntity;
use Wame\ChameleonComponents\Components\SingleEntityControl;
use Wame\ListControl\Components\IEntityControlFactory;


interface IUserControlFactory extends IEntityControlFactory
{
    /** @return UserControl */
    public function create($entity = null);
}


class UserControl extends SingleEntityControl
{
    public function __construct(\Nette\DI\Container $container, $entity = null) 
    {
        parent::__construct($container, $entity);
        
        
    }
    
    protected function getEntityType()
    {
        return UserEntity::class;
    }
    
    
    public function render() {
        parent::render();
        
        $this->template->columns = ['column1', '2'];
    }
    
}
