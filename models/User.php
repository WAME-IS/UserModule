<?php

namespace Wame\Security;

use Nette\Security\User as NUser;


class User extends NUser
{
    public function getEntity()
    {
        return $this->getIdentity();
    }

}
