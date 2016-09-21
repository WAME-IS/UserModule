<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Grids\GroupActions;

use Wame\DataGridControl\BaseGridItem;
use Wame\UserModule\Repositories\UserRepository;
use Wame\PermissionModule\Repositories\RoleRepository;

class ChangeRoleSelected extends BaseGridItem
{
    /** @var UserRepository */
    private $userRepository;
    
    /** @var RoleRepository */
    private $roleRepository;
    
    
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    
    
    /** {@inheritDoc} */
	public function render($grid)
    {
        $roles = $this->roleRepository->findPairs([], 'name', [], 'name');
        
        $grid->addGroupAction('Change role', $roles)->onSelect[] = [$this, 'changeRoleSelected'];
        
		return $grid;
	}
    
    /**
     * Change role selected callback
     */
    public function changeRoleSelected(array $ids, $role)
    {
        $users = $this->userRepository->find(['id => IN' => $ids]);
        
        foreach($users as $user) {
            $user->role = $role;
        }
        
        if ($this->getParent()->getPresenter()->isAjax()) {
            $this->getParent()->reload();
        } else {
            $this->redirect('this');
        }
    }
    
}