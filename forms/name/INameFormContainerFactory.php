<?php

namespace Wame\UserModule\Forms;

interface INameFormContainerFactory
{
	/** @return NameFormContainer */
	public function create();
	
}