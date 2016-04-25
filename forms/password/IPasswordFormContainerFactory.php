<?php

namespace Wame\UserModule\Forms;

interface IPasswordFormContainerFactory
{
	/** @return PasswordFormContainer */
	public function create();
	
}