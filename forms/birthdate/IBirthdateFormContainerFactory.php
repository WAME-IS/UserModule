<?php

namespace Wame\UserModule\Forms;

interface IBirthdateFormContainerFactory
{
	/** @return BirthdateFormContainer */
	public function create();
	
}