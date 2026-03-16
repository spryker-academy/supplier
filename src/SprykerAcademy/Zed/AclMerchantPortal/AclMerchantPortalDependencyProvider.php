<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\AclMerchantPortal;

use Pyz\Zed\AclMerchantPortal\AclMerchantPortalDependencyProvider as PyzAclMerchantPortalDependencyProvider;
use SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Plugin\AclMerchantPortal\SupplierMerchantPortalGuiMerchantAclRuleExpanderPlugin;

class AclMerchantPortalDependencyProvider extends PyzAclMerchantPortalDependencyProvider
{
    /**
     * @return list<\Spryker\Zed\AclMerchantPortalExtension\Dependency\Plugin\MerchantAclRuleExpanderPluginInterface>
     */
    protected function getMerchantAclRuleExpanderPlugins(): array
    {
        return array_merge(parent::getMerchantAclRuleExpanderPlugins(), [
            new SupplierMerchantPortalGuiMerchantAclRuleExpanderPlugin(),
        ]);
    }
}
