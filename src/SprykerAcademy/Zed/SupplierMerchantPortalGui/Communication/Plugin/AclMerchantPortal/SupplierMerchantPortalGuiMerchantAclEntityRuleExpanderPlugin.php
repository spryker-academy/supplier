<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Plugin\AclMerchantPortal;

use Generated\Shared\Transfer\AclEntityRuleTransfer;
use Spryker\Zed\AclMerchantPortalExtension\Dependency\Plugin\MerchantAclEntityRuleExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * The Merchant Portal restricts every database entity for merchant users (ACL entity rules). Route rules alone are not
 * enough: without an entity rule, every query on the supplier tables returns nothing. This plugin grants the merchant
 * users full access to the supplier tables. Run `acl-entity:synchronize` once so existing merchants receive the rule.
 *
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\SupplierMerchantPortalGuiCommunicationFactory getFactory()
 */
class SupplierMerchantPortalGuiMerchantAclEntityRuleExpanderPlugin extends AbstractPlugin implements MerchantAclEntityRuleExpanderPluginInterface
{
    /**
     * @uses \Spryker\Shared\AclEntity\AclEntityConstants::SCOPE_GLOBAL
     *
     * @var string
     */
    protected const SCOPE_GLOBAL = 'global';

    /**
     * @uses \Spryker\Shared\AclEntity\AclEntityConstants::OPERATION_MASK_CRUD
     *
     * @var int
     */
    protected const OPERATION_MASK_CRUD = 0b1111;

    /**
     * @var array<string>
     */
    protected const SUPPLIER_ENTITIES = [
        'Orm\Zed\Supplier\Persistence\PyzSupplier',
        'Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier',
        'Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocation',
    ];

    /**
     * @param array<\Generated\Shared\Transfer\AclEntityRuleTransfer> $aclEntityRuleTransfers
     *
     * @return array<\Generated\Shared\Transfer\AclEntityRuleTransfer>
     */
    public function expand(array $aclEntityRuleTransfers): array
    {
        foreach (static::SUPPLIER_ENTITIES as $entity) {
            if (!class_exists($entity)) {
                continue;
            }

            $aclEntityRuleTransfers[] = (new AclEntityRuleTransfer())
                ->setEntity($entity)
                ->setScope(static::SCOPE_GLOBAL)
                ->setPermissionMask(static::OPERATION_MASK_CRUD);
        }

        return $aclEntityRuleTransfers;
    }
}
