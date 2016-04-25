<?php

namespace Wame\UserModule\Forms;

interface IDegreeFormContainerFactory
{
	/** @return DegreeFormContainer */
	public function create();
	
}