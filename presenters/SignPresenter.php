<?php

namespace App\UserModule\Presenters;

use Wame\UserModule\Forms\SignInForm;
use Wame\UserModule\Forms\SignUpForm;

class SignPresenter extends \App\Core\Presenters\BasePresenter
{	
	/** @var SignInForm @inject */
	public $signInForm;

	/** @var SignUpForm @inject */
	public $signUpForm;
	
	
	public function actionIn()
	{
		if ($this->user->isLoggedIn()) {
			$this->flashMessage(_('You are now logged.'), 'info');
			$this->redirect(':User:Profile:');
		}
	}
	
	
	public function actionUp()
	{
		if ($this->user->isLoggedIn()) {
			$this->flashMessage(_('You are now logged.'), 'info');
			$this->redirect(':User:Profile:');
		}
	}
	
	
	public function actionOut()
	{
		$this->getUser()->logout(true);
		$this->redirect(':User:Sign:in');
	}
	
	
	/**
	 * Sign in form
	 * 
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->signInForm->build();
		
		$form['email']->setOption('description',\Nette\Utils\Html::el('span')
			->addAttributes(array(
				'class' => 'input-group-addon'
				))
			->setHtml(\Nette\Utils\Html::el('span')
				->addAttributes(array(
					'class' => 'glyphicon glyphicon-user'
					))
				)
			);
		
		$form['password']->setOption('description',\Nette\Utils\Html::el('span')
			->addAttributes(array(
				'class' => 'input-group-addon'
				))
			->setHtml(\Nette\Utils\Html::el('span')
				->addAttributes(array(
					'class' => 'glyphicon glyphicon-lock'
					))
				)
			);
		
		$form['email']->setOption('group', 'div class="input-group input-group-lg"');
		$form['email']->setAttribute('placeholder', _('Username'));
		
		$form['password']->setOption('group', 'div class="input-group input-group-lg"');
		$form['password']->setAttribute('placeholder', _('Password'));

		$renderer = $form->setRenderer(new \App\Core\Forms\CustomRenderer())->getRenderer();

		return $form;
	}
	
	
	/**
	 * Sign up form
	 * 
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignUpForm()
	{
		$form = $this->signUpForm->build();
		
		$form['nick']->setOption('description',\Nette\Utils\Html::el('span')
			->addAttributes(array(
				'class' => 'input-group-addon'
				))
			->setHtml(\Nette\Utils\Html::el('span')
				->addAttributes(array(
					'class' => 'glyphicon glyphicon-user'
					))
				)
			);
		
		$form['email']->setOption('description',\Nette\Utils\Html::el('span')
			->addAttributes(array(
				'class' => 'input-group-addon'
				))
			->setHtml(\Nette\Utils\Html::el('span')
				->addAttributes(array(
					'class' => 'glyphicon glyphicon-envelope'
					))
				)
			);
		
		$form['password']->setOption('description',\Nette\Utils\Html::el('span')
			->addAttributes(array(
				'class' => 'input-group-addon'
				))
			->setHtml(\Nette\Utils\Html::el('span')
				->addAttributes(array(
					'class' => 'glyphicon glyphicon-lock'
					))
				)
			);
		
		$form['password_repeat']->setOption('description',\Nette\Utils\Html::el('span')
			->addAttributes(array(
				'class' => 'input-group-addon'
				))
			->setHtml(\Nette\Utils\Html::el('span')
				->addAttributes(array(
					'class' => 'glyphicon glyphicon-lock'
					))
				)
			);
		
		$form['nick']->setOption('group', 'div class="input-group input-group-lg"');
		$form['nick']->setAttribute('placeholder', _('Username'));
		
		$form['email']->setOption('group', 'div class="input-group input-group-lg"');
		$form['email']->setAttribute('placeholder', _('E-mail'));
		
		$form['password']->setOption('group', 'div class="input-group input-group-lg"');
		$form['password']->setAttribute('placeholder', _('Password'));
		
		$form['password_repeat']->setOption('group', 'div class="input-group input-group-lg"');
		$form['password_repeat']->setAttribute('placeholder', _('Password repeat'));

		$renderer = $form->setRenderer(new \App\Core\Forms\CustomRenderer())->getRenderer();
		
		return $form;
	}
	
	
	public function renderIn()
	{
		$this->template->siteTitle = _('Login');
	}
	
	
	public function renderUp()
	{
		$this->template->siteTitle = _('Registration');
	}

}
