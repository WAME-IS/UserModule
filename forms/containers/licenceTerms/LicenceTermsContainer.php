<?php

namespace Wame\UserModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;


interface ILicenceTermsContainerFactory extends IBaseContainer
{
    /** @return LicenceTermsContainer */
    public function create();
}


class LicenceTermsContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
    {
        $this->addCheckbox('licence_terms', _('Licence terms'))
                ->setRequired(_('You must agree to the license terms to continue.'));
    }

}
