<?php

namespace App\AdminModule\Presenters;

use Wame\MenuModule\Forms\MenuItemForm;

class UserMenuItemPresenter extends \App\AdminModule\Presenters\BasePresenter
{	
	/** @var MenuItemForm @inject */
	public $menuItemForm;


	/**
	 * Sign up menu item form
	 * 
	 * @return MenuItemForm
	 */
	protected function createComponentSignUpMenuItemForm()
	{
		$form = $this->menuItemForm
						->setActionForm('signUpMenuItemForm')
						->setType('signUp')
						->setId($this->id)
						->addFormContainer(new \Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuManager\Forms\SignUpFormContainer(), 'SignUpFormContainer', 50)
						->build();
		
		$form['showing']->setDisabled()->setDefaultValue(0);

		return $form;
	}


	/**
	 * Sign in menu item form
	 * 
	 * @return MenuItemForm
	 */
	protected function createComponentSignInMenuItemForm()
	{
		$form = $this->menuItemForm
						->setActionForm('signInMenuItemForm')
						->setType('signIn')
						->setId($this->id)
						->addFormContainer(new \Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuManager\Forms\SignInFormContainer(), 'SignInFormContainer', 50)
						->build();
		
		$form['showing']->setDisabled()->setDefaultValue(0);

		return $form;
	}


	/**
	 * Sign out menu item form
	 * 
	 * @return MenuItemForm
	 */
	protected function createComponentSignOutMenuItemForm()
	{
		$form = $this->menuItemForm
						->setActionForm('signOutMenuItemForm')
						->setType('signOut')
						->setId($this->id)
						->addFormContainer(new \Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuManager\Forms\SignOutFormContainer(), 'SignOutFormContainer', 50)
						->build();
		
		$form['showing']->setDisabled()->setDefaultValue(1);

		return $form;
	}


	/**
	 * User settings menu item form
	 * 
	 * @return MenuItemForm
	 */
	protected function createComponentUserSettingsMenuItemForm()
	{
		$form = $this->menuItemForm
						->setActionForm('userSettingsMenuItemForm')
						->setType('userSettings')
						->setId($this->id)
						->addFormContainer(new \Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuManager\Forms\UserSettingsFormContainer(), 'UserSettingsFormContainer', 50)
						->build();
		
		$form['showing']->setDisabled()->setDefaultValue(1);

		return $form;
	}


	/**
	 * User profile menu item form
	 * 
	 * @return MenuItemForm
	 */
	protected function createComponentUserProfileMenuItemForm()
	{
		$form = $this->menuItemForm
						->setActionForm('userProfileMenuItemForm')
						->setType('userProfile')
						->setId($this->id)
						->addFormContainer(new \Wame\UserModule\Vendor\Wame\MenuModule\Components\MenuManager\Forms\UserProfileFormContainer(), 'UserProfileFormContainer', 50)
						->build();
		
		$form['showing']->setDisabled()->setDefaultValue(1);

		return $form;
	}
	
	
	public function renderSignUp()
	{
		if ($this->id) {
			$this->template->siteTitle = _('Edit sign up item in menu');
		} else {
			$this->template->siteTitle = _('Add sign up item to menu');
		}
	}
	
	
	public function renderSignIn()
	{
		if ($this->id) {
			$this->template->siteTitle = _('Edit sign in item in menu');
		} else {
			$this->template->siteTitle = _('Add sign in item to menu');
		}
	}
	
	
	public function renderSignOut()
	{
		if ($this->id) {
			$this->template->siteTitle = _('Edit sign out item in menu');
		} else {
			$this->template->siteTitle = _('Add sign out item to menu');
		}
	}
	
	
	public function renderUserSettings()
	{
		if ($this->id) {
			$this->template->siteTitle = _('Edit user settings item in menu');
		} else {
			$this->template->siteTitle = _('Add user settings item to menu');
		}
	}
	
	
	public function renderUserProfile()
	{
		if ($this->id) {
			$this->template->siteTitle = _('Edit user profile item in menu');
		} else {
			$this->template->siteTitle = _('Add user profile item to menu');
		}
	}

}
