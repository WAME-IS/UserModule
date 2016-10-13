<?php

namespace Wame\UserModule\Vendor\Wame\Registers;


abstract class UserColumnType implements IRegisterType
{    
    /**
     * @return string Column title
     */
    public abstract function getTitle();
    
    /**
     * @return string Column
     */
    public abstract function getColumn();
    
}
