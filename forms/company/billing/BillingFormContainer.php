<?php

namespace Wame\UserModule\Forms\Company;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;


interface IBillingDataFormContainerFactory
{
	/** @return BillingDataFormContainer */
	public function create();
}


class BillingDataFormContainer extends BaseFormContainer
{
    public function attached($object) 
	{
        parent::attached($object);

        if ($object instanceof Form) {
			$object->onSuccess[] = function (Form $form) 
			{
				if ($form->parent->id) {
					$ico = $form->getValues()->ico;
					$dic = $form->getValues()->dic;
					$icDph = $form->getValues()->icDph;

					$form->parent->companyEntity->setIco($ico);
					$form->parent->companyEntity->setDic($dic);
					$form->parent->companyEntity->setIcDph($icDph);
				}
				
				return $form;
            };
        }
    }
	

    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('ico', _('IČO'));
		
		$form->addText('dic', _('DIČ'));
		
		$form->addText('icDph', _('IČ DPH'));
    }
	
	
	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$form['ico']->setDefaultValue($object->companyEntity->getIco());
		$form['dic']->setDefaultValue($object->companyEntity->getDic());
		$form['icDph']->setDefaultValue($object->companyEntity->getIcDph());
	}

}